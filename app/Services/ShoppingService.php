<?php 
namespace App\Services;

use App\AppData;
use App\Models\RollTransaction;
use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\RollRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingService{
  private const ALL_ROLL_SELECT_COLUMN = [
    AppData::TABLE_ROLL.".id",
    AppData::TABLE_ROLL.".name",
    AppData::TABLE_ROLL.".code",
    AppData::TABLE_ROLL.".quantity_roll",
    AppData::TABLE_ROLL.".quantity_unit",
    AppData::TABLE_ROLL.".basic_price",
    AppData::TABLE_ROLL.".selling_price",
    AppData::TABLE_ROLL.".unit_id",
    AppData::TABLE_ROLL.".qrcode",
  ];

  private const ALL_CUSTOMER_SELECT_COLUMN = [
    AppData::TABLE_USER.".id",
    AppData::TABLE_USER.".id_number",
    AppData::TABLE_USER.".name",
    AppData::TABLE_USER.".address",
    AppData::TABLE_USER.".phone",
  ];


  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Shopping",
      "cardTitle" => "Shopping",
      "rolls" => (new RollRepository())->getAllDataRoll(self::ALL_ROLL_SELECT_COLUMN),
      "customers" => (new CustomerRepository())->getAllDataCustomer(self::ALL_CUSTOMER_SELECT_COLUMN)
    ];
  }


  /**
   * Description : use to purchase new order
   * 
   * @param array $requestedData
   * @return object of stored invoice
   */
  public function purchase(array $requestedData)
  {
    $rollsId = array_column($requestedData["rolls"], 'roll_id');
    $rolls = (new RollRepository())->getDataRollByIds($rollsId);

    try{
      DB::beginTransaction();
      
      $storedInvoice = $this->addNewInvoice($requestedData, $rolls);
      
      #to add roll transaction hisotry
      $this->addNewRollTransaction($requestedData["rolls"], $rolls, $storedInvoice->id);

      #to reduce data roll that sold out
      $this->reduceQuantityRollAndUnit($requestedData["rolls"]);


      DB::commit();
    }catch(Exception $e){
      DB::rollBack();
      return false;
    }

    return $storedInvoice;
  }

  /**
   * Description : use to add new invoice data
   * 
   * @param array $requestedData from client
   * @param ?object $rolls data from database
   * @return ?object Stored invoice
   */
  private function addNewInvoice(array $requestedData, ?object $rolls):?object
  {
    $totalPayment = $this->getTotalPayment($requestedData["rolls"]);
    $totalCapital = $this->getTotalCapital($requestedData["rolls"], $rolls);
    $dataInvoice = [
      "code" => $this->getGeneratedInvoiceCode(),
      "is_paid_off" => true,
      "total_capital" => $totalCapital,
      "total_payment" => $totalPayment,
      "total_profit" => $totalPayment-$totalCapital,
      "payment_type" => $requestedData["payment_type"],
      "customer_id" => $requestedData["customer_id"],
      "user_id" => Auth::user()->id
    ];

    return (new InvoiceRepository())->addNewDataRepository($dataInvoice);
  }


  /**
   * Decsription : use to reduce all data quantity roll and unit
   * 
   * @param array $requestedData from client
   */
  private function reduceQuantityRollAndUnit(array $requestedData):void
  {
    foreach ($requestedData as $roll) {
      (new RollRepository())
        ->decreaseQuantityRollAndUnit(
          $roll["roll_id"], 
          $roll["quantity_roll"],
          $roll["quantity_unit"]
        );
    }
  }


  /**
   * Description: use to add new data roll transaction
   * 
   * @param array $requestedRolls data array rolls from client request
   * @param ?object $rolls from database base on requestedRoll
   * @param int $invoice id
   */
  private function addNewRollTransaction(array $requestedRolls, ?object $rolls, int $invoiceId):void
  {
    $dataTransaction = $requestedRolls;
    $now = Carbon::now();
    
    foreach ($dataTransaction as $key => $item) {
      $dataTransaction[$key]["type"] = "sold";
      $dataTransaction[$key]["user_id"] = Auth::user()->id;
      $dataTransaction[$key]["invoice_id"] = $invoiceId;

      $dataTransaction[$key]["capital"] = 0;
      $dataTransaction[$key]["created_at"] = $now;
      $dataTransaction[$key]["updated_at"] = $now;
      foreach ($rolls as $subItem) {
        if($subItem->id == $item["roll_id"]){
          $dataTransaction[$key]["capital"] = $subItem->basic_price * $item["quantity_unit"];
        }
      }
      $dataTransaction[$key]["profit"] = $dataTransaction[$key]["sub_total"] - $dataTransaction[$key]["capital"];
      unset($dataTransaction[$key]["sub_total"]);
    }

    RollTransaction::insert($dataTransaction);
  }
 

  /**
   * Description : use to generate invoice code with year, month, and number
   * 
   * @return string of generated invoice code
   */
  private function getGeneratedInvoiceCode():string
  {
    $now = Carbon::now();
    $month = $now->month;
    $year = $now->year;
    $newCode = "INV-$year-$month-";
    $dataInvoice = (new InvoiceRepository())->getLatestDataInvoiceThisMonth();

    if($dataInvoice){
      $code = $dataInvoice->code;
      $code = explode('-', $code);
      $lastNumber = end($code);
      $newCode .= getIncreasedDigitNumber($lastNumber);
    }else{
      $newCode .= "0001";
    }
    return $newCode;
  }


  /**
   * Description : use to get total capital base on request and basic price from database
   * 
   * @param array $requestedRolls from client
   * @param ?object of rolls from database
   * @return int $totalCapital
   */
  public function getTotalCapital(array $requestedRolls, ?object $rolls):int
  {
    $totalCapital = 0;

    foreach ($requestedRolls as $roll) {
      foreach ($rolls as $item) {
        if($roll["roll_id"]==$item->id){
          $totalCapital+= $item->basic_price * $roll["quantity_unit"];
        }
      }
    }

    return $totalCapital;
  }

  /**
   * Description : use to get all total payment from client request
   * 
   * @param array $requestedRolls from client
   * @return int of total payment
   */
  public function getTotalPayment(array $requestedRolls):int
  {
    return array_sum(array_column($requestedRolls, 'sub_total'));
  }
}

?>