<?php 
namespace App\Services;

use App\AppData;
use App\Repositories\RoleRepository;
use App\Repositories\RollRepository;
use App\Repositories\UnitRepository;

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
    $requestedData["barcode"] = $this->getGenerateBarcode();
    return (new RollRepository())->addNewDataRoll($requestedData);
  }


  /**
   * Description : use to get generated barcode code
   * 
   * @return string of generated barcode
   */
  private function getGenerateBarcode():string
  {
    return randomString(AppData::BARCODE_LENGTH);
  }
}

?>