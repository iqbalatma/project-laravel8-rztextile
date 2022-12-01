<?php 
namespace App\Services;

use App\Repositories\InvoiceRepository;

class InvoiceService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Invoice",
      "cardTitle" => "Invoices",
      "invoices" => (new InvoiceRepository())->getAllDataInvoicePaginated()
    ];
  }

  public function reduceBill(int $invoiceId, int $paidAmount):void
  {
    $invoice = (new InvoiceRepository())->getDataInvoiceById($invoiceId);

    if($paidAmount >= $invoice->bill_left){
      $paidAmount = $invoice->bill_left;
      $invoice->is_paid_off = true;
    }
    $invoice->bill_left -= $paidAmount;
    $invoice->total_paid_amount += $paidAmount;
    $invoice->save();
  }
}

?>