<?php 
namespace App\Services;

use App\Exceptions\InvalidActionException;
use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;
use App\Repositories\UnitRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class RollService{

  private const ALL_UNIT_SELECT_COLUMN = ["id", "name"];
  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Roll",
      "cardTitle" => "Rolls",
      "rolls" => (new RollRepository())->getAllDataRollPaginated()
    ];
  }


  /**
   * Description : use to get data for create form roll
   * 
   * @return array
   */
  public function getCreateData():array
  {
    return [
      "title" => "Roll",
      "cardTitle" => "Rolls",
      "units" => (new UnitRepository())->getAllDataUnit(self::ALL_UNIT_SELECT_COLUMN)
    ];
  }


  /**
   * Description : use to add new data roll
   * 
   * @param array $requestedData
   * @return object of eloquent
   */
  public function storeNewData(array $requestedData):?object
  {
    $qrService = new QRCodeService();
    try{
      DB::beginTransaction();
      $qrcode = $qrService->getGeneratedQrCode();
      $qrcodeFileName = $qrService->storeNewQRCode($qrcode);
  
      $requestedData["qrcode"] = $qrcode;
      $requestedData["qrcode_image"] = $qrcodeFileName;

      $roll = (new RollRepository())->addNewDataRoll($requestedData);

      $requestedData["roll_id"] = $roll->id;
      $requestedData["type"] = "restock";
      $requestedData["user_id"] = 1;
      (new RollTransactionRepository())->addNewDataRollTransaction($requestedData);

      DB::commit();
    }catch(Exception $e){
      DB::rollBack();
      throw new InvalidActionException("Add new roll failed. Something went wrong !");
    }
    
    return $roll;
  }

  public function getEditData(int $id):array
  {
    return [
      "title" => "Roll",
      "cardTitle" => "Rolls",
      "units" => (new UnitRepository())->getAllDataUnit(self::ALL_UNIT_SELECT_COLUMN),
      "roll" => (new RollRepository())->getDataRollById($id)
    ];
  }
  

  public function updateData(int $id, array $requestedData):bool
  {
    return (new RollRepository())->updateDataRollById($id, $requestedData);
  }
}

?>