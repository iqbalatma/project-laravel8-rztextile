<?php

namespace App\Services\DataMaster;

use App\AppData;
use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelExtend\BaseService;

class CustomerService extends BaseService
{
    protected $repository;
    private const SHOW_CUSTOMER_SELECT_COLUMN = [
        "id",
        "name",
        "address",
        "phone",
        "role_id",
        "id_number",
        "updated_at"
    ];
    private const ALL_CUSTOMER_SELECT_COLUMN = [
        "users.id",
        "name",
        "address",
        "phone",
        "role_id",
        "id_number",
        "users.updated_at",
        "invoices.customer_id",
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
     * Description : use to add new data
     *
     * @param array $requestedData
     */
    public function storeNewData(array $requestedData): ?object
    {
        $requestedData["role_id"] = AppData::ROLE_ID_CUSTOMER;
        return $this->repository->addNewData($requestedData);
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
    public function updateData(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $data = $this->repository->updateDataById($id, $requestedData, isReturnObject: false);
            $response = [
                "success" => true,
                "data" => $data,
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
    public function deleteData(int $id): array
    {
        try {
            $this->checkData($id);
            $data = $this->repository->deleteDataById($id);
            $response = [
                "success" => true,
                "data" => $data,
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
