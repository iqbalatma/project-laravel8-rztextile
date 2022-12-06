<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceRepository{

  private $month, $year;
  public function __construct() {
    $this->month = Carbon::now()->format("m");
    $this->year = Carbon::now()->format("Y");
  }


  public function getAllDataInvoicePaginated(array $columns = ["*"], $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Invoice::with(["customer", "user"])
      ->select($columns)
      ->orderBy("created_at", "DESC")
      ->paginate($perPage)
      ->appends(request()->query());;
  }

  public function getPaidOffDataInvoicePaginated(array $columns = ["*"], $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Invoice::with(["customer", "user"])
      ->select($columns)
      ->where("is_paid_off", true)
      ->where("bill_left", "=", 0)
      ->orderBy("created_at", "DESC")
      ->paginate($perPage)
      ->appends(request()->query());;
  }

  public function getNotPaidOffDataInvoicePaginated(array $columns = ["*"], $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Invoice::with(["customer", "user"])
      ->select($columns)
      ->where("is_paid_off", false)
      ->where("bill_left", ">", 0)
      ->orderBy("created_at", "DESC")
      ->paginate($perPage)
      ->appends(request()->query());;
  }

  public function addNewDataRepository(array $requestedData):object
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
    return Invoice::find($id, $columns);
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
}

?>