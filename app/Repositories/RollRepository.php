<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Roll;

class RollRepository{

  public function getAllDataRollPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Roll::select($columns)
      ->paginate($perPage);
  }

  public function addNewDataRoll(array $requestedData):object
  {
    return Roll::create($requestedData);
  }

  public function getDataRollById(int $id, array $columns = ["*"]):?object
  {
    return Roll::find($id, $columns);
  }

  public function updateDataRollById(int $id, array $requestedData):bool
  {
    return Roll::where("id", $id)->update($requestedData);
  }

}

?>