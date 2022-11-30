<?php 
namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Payment",
      "cardTitle" => "Payments",
      "payments" => (new PaymentRepository())->getAllDataPaymentPaginated(),
    ];
  }

}

?>