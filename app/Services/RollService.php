<?php 
namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\RollRepository;

class RollService{

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
}

?>