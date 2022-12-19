<?php

namespace App\Repositories;

use App\AppData;
use App\Models\User;

class CustomerRepository
{

    public function getAllDataCustomerPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return User::with("role")
            ->select($columns)
            ->where("role_id", AppData::ROLE_ID_CUSTOMER)
            ->paginate($perPage);
    }

    public function getAllDataCustomer(array $columns = ["*"])
    {
        return User::with("role")
            ->select($columns)
            ->where("role_id", AppData::ROLE_ID_CUSTOMER)
            ->get();
    }


    public function addNewDataCustomer(array $requestedData): ?object
    {
        return User::create($requestedData);
    }

    public function getCustomerById(int $id, array $columns = ["*"])
    {
        return User::find($id, $columns);
    }

    public function getCustomerByIds(array $ids, array $columns = ["*"])
    {
        return User::select($columns)->find($ids);
    }

    public function updateCustomerById(int $id, array $requestedData): bool
    {
        return User::where("id", $id)->update($requestedData);
    }

    public function deleteCustomerById(int $id): bool
    {
        return User::destroy($id);
    }

    public function getDataCustomerForRFM()
    {
        return User::select("id", "name")
            ->withCount("invoiceCustomer")
            ->withMax("invoiceCustomer", "total_bill")
            ->withMax("invoiceCustomer", "created_at")
            ->where("role_id", 5)
            ->get();
    }
}
