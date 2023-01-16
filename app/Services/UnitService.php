<?php

namespace App\Services;

use App\Repositories\UnitRepository;

class UnitService
{

    private $repository;

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
        return [
            "title"       => "Edit Unit",
            "description" => "Form for edit data unit",
            "cardTitle"   => "Edit Unit",
            "unit"        => $this->repository->getDataById($id)
        ];
    }

    /**
     * Description : use to update new data by id
     *
     * @return bool status update success or not
     */
    public function updateData(int $id, array $requestedData): object
    {
        return $this->repository->updateDataById($id, $requestedData);
    }

    /**
     * Description : use to add new data unit
     *
     * @param array $requestedData validated data from form
     */
    public function storeNewData(array $requestedData): object
    {
        return $this->repository->addNewData($requestedData);
    }


    /**
     * Description : use to delete data by id
     *
     * @param int $id
     * @return bool status of delete data success or not
     */
    public function deleteData(int $id): bool
    {
        return $this->repository->deleteDataById($id);
    }
}
