<?php 
namespace App\Services;

use App\AppData;
use App\Repositories\InvoiceRepository;

class ReportService{

  /**
   * Description : use to get all data for view index report
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Reports",
      "cardTitle" => "Reports",
    ];
  }

  public function downloadReport(array $requestedData)
  {
    $startDate = $requestedData["start_date"];
    $endDate = $requestedData["end_date"];
    $dataSet = [
      "title" => "RZ Textile Report",
      "companyName" => AppData::COMPANY_NAME,
      "companyEmail" => AppData::COMPANY_EMAIL,
      "companyAddress" => AppData::COMPANY_PHONE,
      "start_date" => $startDate,
      "end_date" =>  $endDate
    ];

    if($requestedData["sales_report"]){
      $salesReport = (new InvoiceRepository())->getDataInvoiceReport(
        [$startDate, $endDate]
      );

      $dataSet["sales_report"] = $this->getDataSummarySalesReport($salesReport);
    }

    return $dataSet;
  }


  private function getDataSummarySalesReport($dataSet)
  {
    $dataSetCollection = collect($dataSet);
    return [
      "total_invoice" => $dataSetCollection->count(),
      "total_paid_amount" => $dataSetCollection->sum("total_paid_amount"),
      "total_bill_left" => $dataSetCollection->sum("bill_left"),
      "total_profit" => $dataSetCollection->sum("total_profit"),
      "total_capital" => $dataSetCollection->sum("total_capital"),
      "total_bill" => $dataSetCollection->sum("total_bill"),
      "customer" => $dataSetCollection->groupBy("customer_id")->map(function ($row){
        return $row->sum("total_bill");
      }),
      "all_invoice" => $dataSetCollection,
      "paid_off_invoice" => $dataSetCollection->where("is_paid_off", true),
      "not_paid_off_invocie" => $dataSetCollection->where("is_paid_off", false),
    ];
  }



}

?>