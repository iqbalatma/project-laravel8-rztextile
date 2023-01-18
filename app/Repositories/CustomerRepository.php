<?php

namespace App\Repositories;

use App\AppData;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelExtend\BaseRepository;

class CustomerRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getAllDataPaginatedWithSearch(string|bool $search = false, array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        $columns = array_merge($columns, [DB::raw("COUNT(*) as total_invoices")]);
        $users = $this->model
            ->with("role")
            ->select($columns)
            ->join("invoices", "invoices.customer_id", "users.id")
            ->where("role_id", AppData::ROLE_ID_CUSTOMER)
            ->groupBy("invoices.customer_id");

        if ($search) {
            $users->where("id_number", "LIKE", "%$search%")
                ->orWhere("name", "LIKE", "%$search%")
                ->orWhere("email", "LIKE", "%$search%")
                ->orWhere("address", "LIKE", "%$search%")
                ->orWhere("phone", "LIKE", "%$search%");
        }

        $users = $users->paginate($perPage)->appends(request()->query());

        return $users;
    }


    public function getAllData(array $columns = ["*"]): ?object
    {
        return $this->model
            ->with("role")
            ->select($columns)
            ->where("role_id", AppData::ROLE_ID_CUSTOMER)
            ->get();
    }

    public function getCustomerByIds(array $ids, array $columns = ["*"])
    {
        return $this->model->select($columns)->find($ids);
    }
}
