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

  public function addNewDataUser(array $requestedData):?object
  {
    return User::create($requestedData);
  }

  public function getDataUserById(int $id, array $columns = ["*"]):?object
  {
    return User::find($id, $columns);
  }

  public function getDataUserByEmail(string $email, array $columns = ["*"])
  {
    return User::where("email", $email)->first($columns);
  }

  public function updateDataUserById(int $id, array $requestedData)
  {
    return User::where("id", $id)->update($requestedData);
  }
}

?>