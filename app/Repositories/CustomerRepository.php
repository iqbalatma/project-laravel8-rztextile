<?php

namespace App\Repositories;

use App\AppData;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class CustomerRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getAllDataPaginatedWithSearch(string|bool $search = false, array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        $users = $this->model
            ->with("role")
            ->select(array_merge($columns, [DB::raw("count(invoices.customer_id) as total_invoices")]))
            ->leftJoin("invoices", "invoices.customer_id", "users.id")
            ->where("users.role_id", AppData::ROLE_ID_CUSTOMER)
            ->groupBy($columns);

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
}
