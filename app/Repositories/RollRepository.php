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

}

?>