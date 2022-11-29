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
      ->paginate($perPage);
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
}

?>