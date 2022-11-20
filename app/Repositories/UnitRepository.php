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
}

?>