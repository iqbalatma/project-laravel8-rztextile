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
      ->paginate($perPage)
      ->appends(request()->query());
  }

  public function getDataPaymentCashPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Payment::with("user", "invoice")
      ->select($columns)
      ->where("payment_type", "cash")
      ->orderBy("created_at","DESC")
      ->paginate($perPage)
      ->appends(request()->query());
  }
 
 
  public function getDataPaymentTransferPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Payment::with("user", "invoice")
      ->select($columns)
      ->where("payment_type", "transfer")
      ->orderBy("created_at","DESC")
      ->paginate($perPage)
      ->appends(request()->query());
  }

  public function getDataLatestPayment(int $limit = 5, array $columns = ["*"])
  {
    return Payment::with("user")
      ->orderBy("created_at", "DESC")
      ->limit($limit)
      ->get($columns);
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