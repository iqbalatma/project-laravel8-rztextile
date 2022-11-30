<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Payment;
use App\Models\Unit;

class PaymentRepository{

  public function addNewDataPayment(array $requestedData):?object
  {
    return Payment::create($requestedData);
  }
 
}

?>