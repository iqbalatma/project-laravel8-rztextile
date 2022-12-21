<?php
namespace App\Repositories;

use App\AppData;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentRepository
{

    public function getAllDataPaymentPaginated(
        string $type = "all",
        string|bool $search = false,
        array $columns = ["*"],
        int $perPage = AppData::DEFAULT_PERPAGE
    ): ?object
    {
        $payments = Payment::with("user", "invoice.customer")
            ->select($columns)
            ->orderBy("created_at", "DESC");

        if ($type !== "all") {
            $payments->where("payment_type", $type);
        }

        if ($search) {
            $payments->where("code", "LIKE", "%$search%")
                ->orWhereHas("user", function ($query) use ($search) {
                    return $query->where("name", "LIKE", "%$search%");
                })
                ->orWhereHas("invoice.customer", function ($query) use ($search) {
                    return $query->where("name", "LIKE", "%$search%");
                });
        }

        $payments = $payments->paginate($perPage)
            ->appends(request()->query());

        return $payments;
    }

    public function getDataLatestPayment(int $limit = 5, array $columns = ["*"])
    {
        return Payment::with("user")
            ->orderBy("created_at", "DESC")
            ->limit($limit)
            ->get($columns);
    }

    public function getLatestDataPaymentThisMonth(array $columns = ["*"]): ?object
    {
        $now = Carbon::now();
        return Payment::select($columns)
            ->whereYear("created_at", "=", $now->year)
            ->whereMonth("created_at", "=", $now->month)
            ->orderBy("created_at", "DESC")
            ->first();
    }

    public function addNewDataPayment(array $requestedData): ?object
    {
        return Payment::create($requestedData);
    }

}

?>
