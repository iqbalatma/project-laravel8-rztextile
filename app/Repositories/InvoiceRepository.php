<?php
namespace App\Repositories;

use App\AppData;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{

    private $month, $year;
    public function __construct()
    {
        $this->month = Carbon::now()->format("m");
        $this->year = Carbon::now()->format("Y");
    }


    public function getAllDataInvoicePaginated(array $columns = ["*"], $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return Invoice::with(["customer", "user"])
            ->select($columns)
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
        ;
    }
    public function getAllDataInvoicePaginated2(
        string $type = "all",
        string|bool $search = false,
        array $columns = ["*"],
        $perPage = AppData::DEFAULT_PERPAGE
    ): ?object
    {
        $invoice = Invoice::with(["customer", "user"])
            ->select($columns)
            ->orderBy("created_at", "DESC");

        if ($type == "paid-off") {
            $invoice->where("is_paid_off", true);
        } elseif ($type == "not-paid-off") {
            $invoice->where("is_paid_off", false)
                ->where("bill_left", ">", 0);
        }

        if ($search) {
            $invoice->where("code", "=", $search);
        }


        $invoice = $invoice
            ->paginate($perPage)
            ->appends(request()->query());

        return $invoice;
    }

    public function getPaidOffDataInvoicePaginated(array $columns = ["*"], $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return Invoice::with(["customer", "user"])
            ->select($columns)
            ->where("is_paid_off", true)
            ->where("bill_left", "=", 0)
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
        ;
    }

    public function getNotPaidOffDataInvoicePaginated(array $columns = ["*"], $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return Invoice::with(["customer", "user"])
            ->select($columns)
            ->where("is_paid_off", false)
            ->where("bill_left", ">", 0)
            ->orderBy("created_at", "DESC")
            ->paginate($perPage)
            ->appends(request()->query());
        ;
    }

    public function addNewDataRepository(array $requestedData): object
    {
        return Invoice::create($requestedData);
    }

    public function getLatestDataInvoiceThisMonth()
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        return Invoice::whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->orderBy("created_at", "DESC")
            ->first();
    }

    public function getDataUnpaidInvoice(array $columns = ["*"])
    {
        return Invoice::select($columns)
            ->where("is_paid_off", 0)
            ->where("bill_left", ">", 0)
            ->get();
    }

    public function getDataInvoiceById(int $id, $columns = ["*"])
    {
        return Invoice::with(["customer", "user", "roll_transaction.roll.unit", "payment"])
            ->select($columns)
            ->find($id);
    }

    public function getAllDataInvoiceTotalBillThisMonth()
    {
        return Invoice::selectRaw("DATE_FORMAT(created_at,'%d') date, SUM(total_bill) as total")
            ->whereYear("created_at", "=", Carbon::now()->format("Y"))
            ->whereMonth("created_at", "=", Carbon::now()->format("m"))
            ->groupBy("date")
            ->get();
    }

    public function getAllDataInvoiceTotalCapitalThisMonth()
    {
        return Invoice::selectRaw("DATE_FORMAT(created_at,'%d') date, SUM(total_capital) as total")
            ->whereYear("created_at", "=", Carbon::now()->format("Y"))
            ->whereMonth("created_at", "=", Carbon::now()->format("m"))
            ->groupBy("date")
            ->get();
    }

    public function getTotalInvoiceMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return Invoice::whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->count();
    }

    public function getTotalProfitMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return Invoice::whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->sum("total_profit");
    }

    public function getDataLatestInvoice($limit = 5, $columns = ["*"])
    {
        return Invoice::with("customer")
            ->orderBy("created_at", "DESC")
            ->limit($limit)
            ->get($columns);
    }

    public function getTotalCapitalMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return Invoice::whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->sum("total_capital");
    }

    public function getTotalBillLeftMonthly($month = null, $year = null)
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        return Invoice::whereYear("created_at", "=", $year)
            ->whereMonth("created_at", "=", $month)
            ->sum("bill_left");
    }

    public function getAllDataInvoiceTotalProfitThisMonth()
    {
        return Invoice::selectRaw("DATE_FORMAT(created_at,'%d') date, SUM(total_profit) as total")
            ->whereYear("created_at", "=", Carbon::now()->format("Y"))
            ->whereMonth("created_at", "=", Carbon::now()->format("m"))
            ->groupBy("date")
            ->get();
    }

    public function getDataInvoiceReport(array $period = [])
    {
        return Invoice::whereBetween("created_at", $period)->get();
    }

    public function getDataInvoiceForRFM()
    {
        return Invoice::select("customer_id", DB::raw("count(*) as total_invoices"), DB::raw("sum(total_bill) as total_bill"), DB::raw("max(created_at) as latest_invoice_date"))
            ->with("customer")
            ->whereNotNull("customer_id")
            ->groupBy("customer_id")
            ->get();
    }
}

?>
