<?php
namespace App\Repositories;

use App\AppData;
use App\Models\RollTransaction;

class RollTransactionRepository
{

    public function getAllDataRollTransactionPaginated(
        string|bool $type = "all",
        string|bool $search = false,
        array $columns = ["*"],
        int $perPage = AppData::DEFAULT_PERPAGE
    ): ?object
    {
        $rollTransactions = RollTransaction::with("invoice")
            ->select($columns)
            ->orderBy("created_at", "DESC");

        if ($type != "all") {
            $rollTransactions->where("type", "=", $type);
        }

        if ($search) {
            $rollTransactions->whereHas("invoice", function ($query) use ($search) {
                return $query->where("code", "LIKE", "%$search%");
            })->orWhereHas("roll", function ($query) use ($search) {
                return $query->where("code", "LIKE", "%$search%")
                    ->orWhere("name", "LIKE", "%$search%")
                    ->orWhereHas(
                        "unit",
                        function ($subQuery) use ($search) {
                            return $subQuery->where("name", "LIKE", "%$search%");
                        }
                    );
            })->orWhereHas("user", function ($query) use ($search) {
                return $query->where("name", "LIKE", "%$search%");
            });
        }


        $rollTransactions = $rollTransactions->paginate($perPage)->appends(request()->query());

        return $rollTransactions;
    }

    public function getDataRollTransactionRestockPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return RollTransaction::with("invoice")
            ->select($columns)
            ->where("type", "restock")
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }


    public function getDataRollTransactionSoldPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return RollTransaction::with("invoice")
            ->select($columns)
            ->where("type", "sold")
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }


    public function getDataRollTransactionBrokenPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return RollTransaction::with("invoice")
            ->select($columns)
            ->where("type", "broken")
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
    }

    public function addNewDataRollTransaction(array $requestedData): ?object
    {
        return RollTransaction::create($requestedData);
    }
}

?>
