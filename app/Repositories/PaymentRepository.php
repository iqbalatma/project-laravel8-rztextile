<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentRepository{

  public function getAllDataPaymentPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Payment::with("user", "invoice")
      ->select($columns)
      ->orderBy("created_at","DESC")
      ->paginate($perPage);
  }

  public function getLatestDataPaymentThisMonth(array $columns = ["*"]):?object
  {
    $now = Carbon::now();
    return Payment::select($columns)
      ->whereYear("created_at", "=", $now->year)
      ->whereMonth("created_at","=", $now->month)
      ->orderBy("created_at", "DESC")
      ->first();
  }

  public function addNewDataPayment(array $requestedData):?object
  {
    return Payment::create($requestedData);
  }
 
}

?>