<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Role;

class RoleRepository{

  public function getAllDataRolePaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Role::select($columns)
      ->paginate($perPage);
  }

}

?>