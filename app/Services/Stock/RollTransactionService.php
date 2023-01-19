<?php

namespace App\Services\Stock;

use App\AppData;
use App\Exceptions\InvalidActionException;
use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelExtend\BaseService;

class RollTransactionService extends BaseService
{

    protected $repository;
    protected $rollRepo;

    public function __construct()
    {
        $this->repository = new RollTransactionRepository();
        $this->rollRepo = new RollRepository();
    }

    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        $type = request("type", "all");

        // switch ($type) {
        //     case "broken":
        //         $rollTransactions = (new RollTransactionRepository())->getDataRollTransactionBrokenPaginated();
        //         break;
        //     case "sold":
        //         $rollTransactions = (new RollTransactionRepository())->getDataRollTransactionSoldPaginated();
        //         break;
        //     case "restock":
        //         $rollTransactions = (new RollTransactionRepository())->getDataRollTransactionRestockPaginated();
        //         break;
        //     default:
        //         $rollTransactions =
        // }

        $search = request()->input("search", false) ?? false;
        $monthYear = request()->input("month_year", false) ?? false;
        $month = false;
        $year = false;
        if ($monthYear) {
            $monthYear = explode("-", $monthYear);
            $year = $monthYear[0];
            $month = $monthYear[1];
        }

        return [
            "title"            => "Roll Transaction",
            "description"      => "Transaction roll in or out",
            "cardTitle"        => "Roll Transactions",
            "type"             => $type,
            "rollTransactions" => $this->repository->getAllDataRollTransactionPaginated($type, $search, $year, $month)
        ];
    }

    /**
     * Get data for create
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Restock & Deadstock",
            "description" => "Restock rolls into storage or take out of stock for broken item roll",
            "cardTitle"   => "Restock & Deadstock",
            "rolls"       => $this->rollRepo->getAllDataRoll()
        ];
    }

    public function addNewData(array $requestedData)
    {
        $requestedData["user_id"] = Auth::user()->id;
        try {
            DB::beginTransaction();
            if ($requestedData["type"] == AppData::TRANSACTION_TYPE_RESTOCK) {
                $rollTransaction = $this->restock($requestedData);
            } else {
                $rollTransaction = $this->deadstock($requestedData);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        return $rollTransaction;
    }

    /**
     * Use to restock the roll
     * @param array $requestedData
     * @return object
     */
    private function restock(array $requestedData): object
    {
        $this->rollRepo->increaseQuantityRollAndUnit(
            $requestedData["roll_id"],
            $requestedData["quantity_roll"],
            $requestedData["quantity_unit"]
        );

        return $this->repository->addNewData($requestedData);
    }

    /**
     * Use to deadstock the roll
     * @param array $requestedData
     * @throws InvalidActionException
     * @return object
     */
    private function deadstock(array $requestedData): object
    {
        $roll = $this->rollRepo->getDataById($requestedData["roll_id"]);

        // Check the quantity before deadstock
        if ($requestedData["quantity_roll"] > $roll->quantity_roll || $requestedData["quantity_unit"] > $roll->quantity_unit) {
            throw new InvalidActionException("Roll quantity or quantity unit cannot bigger than stock on warehouse");
        }

        $this->rollRepo->decreaseQuantityRollAndUnit(
            $requestedData["roll_id"],
            $requestedData["quantity_roll"],
            $requestedData["quantity_unit"]
        );

        return $this->repository->addNewData($requestedData);
    }
}
