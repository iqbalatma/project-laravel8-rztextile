<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\User;

class UserRepository{

  public function getAllDataUserPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return User::with("role")
      ->select($columns)
      ->where("role_id", "!=", AppData::ROLE_ID_CUSTOMER)
      ->paginate($perPage);
  }
}

?>