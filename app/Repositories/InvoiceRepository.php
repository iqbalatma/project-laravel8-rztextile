<?php 
namespace App\Repositories;

use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceRepository{

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