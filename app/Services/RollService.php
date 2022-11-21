<?php 
namespace App\Services;

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

  public function getCreateData():array
  {
    return [
      "title" => "Roll",
      "cardTitle" => "Rolls",
      "units" => (new UnitRepository())->getAllDataUnit(self::ALL_UNIT_SELECT_COLUMN)
    ];
  }
}

?>