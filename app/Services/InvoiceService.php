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
}

?>