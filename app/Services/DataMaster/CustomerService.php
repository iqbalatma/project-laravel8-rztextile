<?php

namespace App\Services\DataMaster;

use App\Repositories\CustomerRepository;
use App\Statics\Tables;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

class CustomerService extends BaseService
{
    protected $repository;
    private const SHOW_CUSTOMER_SELECT_COLUMN = [
        Tables::USERS . ".id",
        Tables::USERS . ".name",
        Tables::USERS . ".address",
        Tables::USERS . ".phone",
        Tables::USERS . ".role_id",
        Tables::USERS . ".id_number",
        Tables::USERS . ".updated_at"
    ];
    private const ALL_CUSTOMER_SELECT_COLUMN = [
        Tables::USERS . ".id",
        Tables::USERS . ".name",
        Tables::USERS . ".address",
        Tables::USERS . ".phone",
        Tables::USERS . ".role_id",
        Tables::USERS . ".id_number",
        Tables::USERS . ".updated_at",
    ];

    public function __construct()
    {
        $this->repository = new CustomerRepository();
    }

    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        $search = request()->input("search", false) ?? false;
        $data = [
            "title"        => "Customer",
            "description"  => "Data customer",
            "customers"      => $this->repository->getAllDataPaginatedWithSearch($search, self::ALL_CUSTOMER_SELECT_COLUMN)
        ];

        return $data;
    }


    /**
     * Description : use to get data for create form
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Customer",
            "description" => "Form for add new data customer",
            "cardTitle"   => "Customers",
        ];
    }

    /**
     * Use to add new data customer
     *
     * @param array $requestedData
     * @return array
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $this->repository->addNewData($requestedData);
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ?  $e->getMessage() : 'Something went wrong'
            ];
        }
        return $response;
    }


    /**
     * Description : use to get data edit by id
     *
     * @param int $id of customer that want to edit
     * @return array
     */
    public function getEditData(int $id): array
    {
        try {
            $this->checkData($id);
            $response = [
                "success" => true,
                "title"       => "Customer",
                "description" => "Form for edit data customer",
                "cardTitle"   => "Customers",
                "customer"    => $this->repository->getDataById($id, self::SHOW_CUSTOMER_SELECT_COLUMN)
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
     * Use to update data customer
     *
     * @param int $id
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $response = [
                "success" => true,
                "data" => $this->repository->updateDataById($id, $requestedData, isReturnObject: false),
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
     * Use to delete data customer by id
     *
     * @param int $id
     * @return array
     */
    public function deleteDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $response = [
                "success" => true,
                "data" => $this->repository->deleteDataById($id),
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
