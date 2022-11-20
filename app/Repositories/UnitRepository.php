<?php 
namespace App\Repositories;

use App\Models\Unit;

class UnitRepository{

  public function getAllDataUnitPaginated(array $columns = ["*"], int $perPage = 10):?object
  {
    return Unit::select($columns)
      ->paginate($perPage);
  }
}

?>