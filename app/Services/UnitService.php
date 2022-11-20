<?php 
namespace App\Services;

use App\Repositories\UnitRepository;

class UnitService{
  public function getAllData()
  {
    return [
      "title" => "Unit",
      "cardTitle" => "Unit",
      "cardDescription" => "Data unit for every rolls",
      "units" => (new UnitRepository())->getAllDataUnitPaginated()
    ];
  }
}

?>