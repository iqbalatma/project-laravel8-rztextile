<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Payment;
use App\Models\Unit;

class PaymentRepository{

  public function getAllDataPaymentPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Payment::with("user", "invoice")
      ->select($columns)
      ->orderBy("created_at","DESC")
      ->paginate($perPage);
  }

  public function addNewDataPayment(array $requestedData):?object
  {
    return Payment::create($requestedData);
  }
 
}

?>