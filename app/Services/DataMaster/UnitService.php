<?php

namespace App\Services\DataMaster;

use App\Repositories\UnitRepository;
use Exception;
use Iqbalatma\LaravelExtend\BaseService;

class UnitService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UnitRepository();
    }

    /**
     * Description : use to get all data unit paginated
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "Unit",
            "description" => "Data unit of every roll",
            "cardTitle"   => "Units",
            "units"       => $this->repository->getAllDataPaginated()
        ];
    }

    /**
     * Description : use to get data for create view
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Unit",
            "description" => "Form for add new data unit",
            "cardTitle"   => "Units",
        ];
    }

    /**
     * Description : use to get unit by id for edit data
     *
     * @param int $id of unit
     * @return array for current data that want to update
     */
    public function getEditData(int $id): array
    {
        $response = [
            "success"      => true,
            "title"       => "Edit Unit",
            "description" => "Form for edit data unit",
            "cardTitle"   => "Edit Unit",
        ];
        try {
            $this->checkData($id);
            $response["unit"] = $this->getData();
        } catch (Exception $e) {
            $response =  [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        }

        return $response;
    }

    /**
     * Use to update data unit
     *
     * @param int $id
     * @param array $requestedData
     * @return array for data response
     */
    public function updateData(int $id, array $requestedData): array
    {
        $response = [];
        try {
            $this->checkData($id);
            $data = $this->repository->updateDataById($id, $requestedData, isReturnObject: false);
            $response = [
                "success" => true,
                "data"    => $data,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        }
        return $response;
    }

    /**
     * Use to add new data uni
     *
     * @param array $requestedData
     * @return object
     */
    public function storeNewData(array $requestedData): object
    {
        return $this->repository->addNewData($requestedData);
    }


    /**
     * Description : use to delete data by id
     *
     * @param int $id
     * @return array for data response
     */
    public function deleteData(int $id): array
    {
        try {
            $this->checkData($id);
            $data = $this->repository->deleteDataById($id);
            $response = [
                "success" => true,
                "data"    => $data,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        }
        return $response;
    }
}
