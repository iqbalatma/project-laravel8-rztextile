<?php 
namespace App\Services;

use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Support\Facades\Auth;

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


  /**
   * Description : use to get data for create form by invoice id
   * 
   * @param int $invoiceId 
   * @return array
   */
  public function getDataCreateByInvoiceId(int $invoiceId):array
  {
    return [
      "title" => "Payment",
      "cardTitle" => "Payments",
      "invoice" => (new InvoiceRepository())->getDataInvoiceById($invoiceId)
    ];
  }

  public function getCreateData():array
  {
    return [
      "title" => "Payment",
      "cardTitle" => "Payments",
      "invoices" => (new InvoiceRepository())->getDataUnpaidInvoice()
    ];
  }

  public function storeNewData(array $requestedData):int
  {
    $change = 0;
    $requestedData["code"] = "ini code";
    $requestedData["user_id"] = Auth::user()->id;
    if($requestedData["paid_amount"] >= $requestedData["bill_left"]){
      $change = $requestedData["paid_amount"] - $requestedData["bill_left"];
      $requestedData["paid_amount"] = $requestedData["bill_left"];
    }
    (new InvoiceService())->reduceBill($requestedData["invoice_id"], $requestedData["paid_amount"]);
    (new PaymentRepository())->addNewDataPayment($requestedData);

    
    return $change;
  }

}

?>