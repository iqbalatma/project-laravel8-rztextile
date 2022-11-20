<?php 
namespace App\Services;

use App\Repositories\UnitRepository;

class UnitService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Unit",
      "cardTitle" => "Units",
      "units" => (new UnitRepository())->getAllDataUnitPaginated()
    ];
  }

  /**
   * Description : use to get data for create view
   * 
   * @return array
   */
  public function getCreateData():array
  {
    return [
      "title" => "Unit",
      "cardTitle" => "Units",
    ];
  }

  /**
   * Description : use to get unit by id for edit data
   * 
   * @param int $id of unit
   * @return array for current data that want to update
   */
  public function getEditData(int $id):array
  {
    $unit = (new UnitRepository())->getDataUnitById($id);
    return [
      "title" => "Edit Unit",
      "cardTitle" => "Edit Unit",
      "unit" => $unit
    ];
  }

  /**
   * Description : use to update new data by id
   * 
   * @return bool status update success or not
   */
  public function updateData(int $id, array $requestedData):bool
  {
    return (new UnitRepository())->updateDataUnitById($id, $requestedData);
  }

  public function storeNewData(array $requestedData):object
  {
    return (new UnitRepository())->addNewDataUnit($requestedData);
  }
}

?>