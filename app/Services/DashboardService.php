<?php 
namespace App\Services;

use App\Repositories\InvoiceRepository;
use Carbon\Carbon;

class DashboardService{
  public function getAllData()
  {
    $invoiceRepository = (new InvoiceRepository());
    return [
      "title" => "Dashboard",
      "total_invoices" => $invoiceRepository->getTotalInvoiceMonthly(),
      "total_bill_left" => formatToRupiah($invoiceRepository->getTotalBillLeftMonthly()),
      "total_profit" => formatToRupiah($invoiceRepository->getTotalProfitMonthly()),
      "total_capital" => formatToRupiah($invoiceRepository->getTotalCapitalMonthly()),
      "currentMonth" => Carbon::now()->format("F")
    ];
  }
}
?>