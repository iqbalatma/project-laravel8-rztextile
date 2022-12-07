<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\RegistrationCredential;

class RegistrationCredentialRepository{
  public function getAllDataRegistrationCredentialPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE)
  {
    return RegistrationCredential::with("role")
      ->select($columns)
      ->paginate($perPage);
  }


  public function addNewDataRegistrationCredential(array $requestedData):?object
  {
    return RegistrationCredential::create($requestedData);
  }


}

?>