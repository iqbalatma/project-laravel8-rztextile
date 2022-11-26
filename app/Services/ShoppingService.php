<?php 
namespace App\Services;

use App\AppData;
use App\Repositories\CustomerRepository;
use App\Repositories\RollRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

  public function purchase(array $requestedData)
  {
    try{
      DB::beginTransaction();
      Log::info($requestedData);
      Log::info(array_column($requestedData["rolls"], 'roll_id'));
      $totalPayment = $this->getTotalPayment($requestedData["rolls"]);
      $totalCapital = $this->getTotalCapital($requestedData["rolls"]);
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


      DB::commit();
    }catch(Exception $e){
      DB::rollBack();
    }

    return $dataInvoice;
  }

  public function getGeneratedInvoiceCode():string
  {
    return "ini adalah code";
  }

  public function getTotalCapital(array $requestedData):int
  {
    $rollsId = array_column($requestedData, 'roll_id');
    $rolls = (new RollRepository())->getDataRollByIds($rollsId);

    $totalCapital = 0;

    foreach ($rollsId as $key => $roll) {
      foreach ($rolls as $key => $item) {
        if($roll==$item->id){
          $totalCapital+= $item->basic_price;
        }
      }
    }

    return $totalCapital;
  }

  public function getTotalPayment(array $requestedData):int
  {
    $totalPayment = array_sum(array_column($requestedData, 'sub_total'));
    
    return $totalPayment;
  }
}

?>