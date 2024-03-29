<?php

namespace App\Repositories;

use App\AppData;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class InvoiceRepository extends BaseRepository
{

    private $month, $year;
    protected $model;
    public function __construct()
    {
        $this->month = Carbon::now()->format("m");
        $this->year = Carbon::now()->format("Y");
        $this->model = new Invoice();
    }


    public function getAllDataInvoicePaginated(
        string $type = "all",
        string|bool $search = false,
        string|bool $year = false,
        string|bool $month = false,
        array $columns = ["*"],
        $perPage = AppData::DEFAULT_PERPAGE
    ): ?object {
        $invoice = $this->model->with(["customer", "user"])
            ->select($columns)
            ->orderBy("created_at", "DESC");

        if ($type == "paid-off") {
            $invoice->where("is_paid_off", true);
        } elseif ($type == "not-paid-off") {
            $invoice->where("is_paid_off", false)
                ->where("bill_left", ">", 0);
        }

        if ($year && $month) {
            $invoice->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
        }

        if ($search) {
            $invoice->where("code", "LIKE", "%$search%")
                ->orWhereHas("customer", function ($query) use ($search, $year, $month) {
                    $query->where("name", "LIKE", "%$search%");
                    if ($year && $month) {
                        $query->whereHas(
                            "invoiceCustomer",
                            function ($subQuery) use ($year, $month) {
                                $subQuery->whereYear("created_at", "=", $year)->whereMonth("created_at", "=", $month);
                            }
                        );
                    }
                });
        }

        $invoice = $invoice
            ->paginate($perPage)
            ->appends(request()->query());

        return $invoice;
    }


    public function getLatestDataInvoiceThisMonth()
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        return $this->model->whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->orderBy("created_at", "DESC")
            ->first();
    }

    public function getDataUnpaidInvoice(array $columns = ["*"])
    {
        return $this->model->select($columns)
            ->where("is_paid_off", 0)
            ->where("bill_left", ">", 0)
            ->get();
    }

    public function getDataInvoiceById(int $id, $columns = ["*"])
    {
        return $this->model->with(["customer", "user", "roll_transaction.roll.unit", "payment"])
            ->select($columns)
            ->find($id);
    }

    public function getAllDataInvoiceTotalBillThisMonth()
    {
        return $this->model->selectRaw("DATE_FORMAT(created_at,'%d') date, SUM(total_bill) as total")
            ->whereYear("created_at", "=", Carbon::now()->format("Y"))
            ->whereMonth("created_at", "=", Carbon::now()->format("m"))
            ->groupBy("date")
            ->get();
    }

    public function getAllDataInvoiceTotalCapitalThisMonth()
    {
        return $this->model->selectRaw("DATE_FORMAT(created_at,'%d') date, SUM(total_capital) as total")
            ->whereYear("created_at", "=", Carbon::now()->format("Y"))
            ->whereMonth("created_at", "=", Carbon::now()->format("m"))
            ->groupBy("date")
            ->get();
    }

    public function getTotalInvoiceMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return $this->model->whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->count();
    }

    public function getTotalProfitMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return $this->model->whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->sum("total_profit");
    }

    public function getDataLatestInvoice($limit = 5, $columns = ["*"])
    {
        return $this->model->with("customer")
            ->orderBy("created_at", "DESC")
            ->limit($limit)
            ->get($columns);
    }

    public function getTotalCapitalMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return $this->model->whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->sum("total_capital");
    }

    public function getTotalBillLeftMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return $this->model->whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->sum("bill_left");
    }

    public function getAllDataInvoiceTotalProfitThisMonth()
    {
        return $this->model->selectRaw("DATE_FORMAT(created_at,'%d') date, SUM(total_profit) as total")
            ->whereYear("created_at", "=", Carbon::now()->format("Y"))
            ->whereMonth("created_at", "=", Carbon::now()->format("m"))
            ->groupBy("date")
            ->get();
    }

    public function getDataInvoiceReport(array $period = [])
    {
        return $this->model->whereBetween("created_at", $period)->get();
    }

    public function getDataInvoiceForRFM()
    {
        return $this->model->select("customer_id", DB::raw("count(*) as total_invoices"), DB::raw("sum(total_bill) as total_bill"), DB::raw("max(created_at) as latest_invoice_date"))
            ->with("customer")
            ->whereNotNull("customer_id")
            ->groupBy("customer_id")
            ->get();
    }
}
