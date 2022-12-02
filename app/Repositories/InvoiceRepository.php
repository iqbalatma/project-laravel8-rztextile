<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceRepository{

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
}

?>