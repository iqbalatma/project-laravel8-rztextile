<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Unit;

class UnitRepository{

  public function getAllDataUnitPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Unit::select($columns)
      ->paginate($perPage);
  }

  public function getDataUnitById(int $id, $columns = ["*"]):?object
  {
    return Unit::find($id, $columns);
  }

  public function updateDataUnitById(int $id, array $requestedData):bool
  {
    return Unit::where("id", $id)->update($requestedData);
  }

  public function addNewDataUnit(array $requestedData):?object
  {
    return Unit::create($requestedData);
  }

  public function deleteDataUnitById(int $id):bool
  {
    return Unit::destroy($id);
  }
}

?>