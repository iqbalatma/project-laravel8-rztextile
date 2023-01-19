<?php

namespace App\Repositories;

use App\AppData;
use App\Models\RollTransaction;
use Iqbalatma\LaravelExtend\BaseRepository;

class RollTransactionRepository extends BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new RollTransaction();
    }

    public function getAllDataRollTransactionPaginated(
        string|bool $type = "all",
        string|bool $search = false,
        string|bool $year = false,
        string|bool $month = false,
        array $columns = ["*"],
        int $perPage = AppData::DEFAULT_PERPAGE
    ): ?object {
        $rollTransactions = $this->model->with("invoice")
            ->select($columns)
            ->orderBy("created_at", "DESC");

        if ($type != "all") {
            $rollTransactions->where("type", "=", $type);
        }


        if ($search) {
            $rollTransactions->orWhereHas("invoice", function ($query) use ($search, $year, $month) {
                return $query->where("code", "LIKE", "%$search%")->whereHas(
                    "roll_transaction",
                    function ($subQuery) use ($year, $month) {
                        return $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                    }
                );
            })
                ->orWhereHas("roll", function ($query) use ($search, $year, $month) {
                    return $query->where("code", "LIKE", "%$search%")
                        ->where("name", "LIKE", "%$search%")
                        ->orWhereHas(
                            "unit",
                            function ($subQuery) use ($search) {
                                return $subQuery->where("name", "LIKE", "%$search%");
                            }
                        )->whereHas(
                            "roll_transaction",
                            function ($subQuery) use ($year, $month) {
                                return $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                            }
                        );;
                })
                ->orWhereHas("user", function ($query) use ($search, $year, $month) {
                    return $query->where("name", "LIKE", "%$search%")->whereHas(
                        "roll_transaction",
                        function ($subQuery) use ($year, $month) {
                            return $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                        }
                    );
                });
        }

        if ($year && $month) {
            $rollTransactions->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
        }



        $rollTransactions = $rollTransactions->paginate($perPage)->appends(request()->query());

        return $rollTransactions;
    }

    public function getDataRollTransactionRestockPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return $this->model->with("invoice")
            ->select($columns)
            ->where("type", AppData::TRANSACTION_TYPE_RESTOCK)
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }


    public function getDataRollTransactionSoldPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return $this->model->with("invoice")
            ->select($columns)
            ->where("type", AppData::TRANSACTION_TYPE_SOLD)
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }


    public function getDataRollTransactionBrokenPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return $this->model->with("invoice")
            ->select($columns)
            ->where("type", AppData::TRANSACTION_TYPE_BROKEN)
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }
}
