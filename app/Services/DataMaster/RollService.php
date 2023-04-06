<?php

namespace App\Services\DataMaster;

use App\Exceptions\InvalidActionException;
use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;
use App\Repositories\UnitRepository;
use App\Services\QRCodeService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseService;

class RollService extends BaseService
{
    protected $repository;
    private $unitRepo;
    private $rollTransRepo;

    public function __construct()
    {
        $this->repository = new RollRepository();
        $this->unitRepo = new UnitRepository();
        $this->rollTransRepo = new RollTransactionRepository();
    }

    private const ALL_UNIT_SELECT_COLUMN = ["id", "name"];
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        $search = request()->input("search", false) ?? false;
        $monthYear = request()->input("month_year") ?? false;
        $year = false;
        $month = false;
        if ($monthYear) {
            $monthYear = explode("-", $monthYear);
            $year = $monthYear[0];
            $month = $monthYear[1];
        }

        return [
            "title"       => "Roll",
            "description" => "Roll data stock quantity, QR code, and roll name",
            "cardTitle"   => "Rolls",
            "rolls"       => $this->repository->getAllDataRollPaginated($search, $year, $month)
        ];
    }


    /**
     * Description : use to get data for create form roll
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Roll",
            "description" => "Form for add new data roll",
            "cardTitle"   => "Rolls",
            "units"       => $this->unitRepo->getAllData(self::ALL_UNIT_SELECT_COLUMN)
        ];
    }


    /**
     * Description : use to add new data roll
     *
     * @param array $requestedData
     * @return array
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $qrService = new QRCodeService();
            DB::beginTransaction();
            $qrcode = $qrService->getGeneratedQrCode();
            $qrcodeFileName = $qrService->storeNewQRCode($qrcode);

            $requestedData["qrcode"] = $qrcode;
            $requestedData["qrcode_image"] = $qrcodeFileName;
            $requestedData["type"] = "restock";
            $requestedData["user_id"] = Auth::id();

            $roll = $this->repository->addNewData($requestedData);
            $requestedData["roll_id"] = $roll->id;

            $this->rollTransRepo->addNewData($requestedData);

            DB::commit();

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            DB::rollBack();

            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ?  $e->getMessage() : 'Something went wrong'
            ];
        }

        return $response;
    }

    /**
     * Use to get data for edit roll
     * @param int $id
     * @return array
     */
    public function getEditData(int $id): array
    {
        try {
            $this->checkData($id);
            $response = [
                "success" => true,
                "title"       => "Edit Roll",
                "description" => "Form for edit roll",
                "cardTitle"   => "Rolls",
                "units"       => $this->unitRepo->getAllData(self::ALL_UNIT_SELECT_COLUMN),
                "roll"        => $this->repository->with(["unit"])->getDataById($id)
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }


    /**
     * Use to update data
     * @param int $id
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $data = $this->repository->updateDataById($id, $requestedData, isReturnObject: false);
            $response = [
                "success" => true,
                "data" => $data
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }
}
