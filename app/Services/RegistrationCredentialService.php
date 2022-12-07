<?php 
namespace App\Services;

use App\Repositories\RegistrationCredentialRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\Str;

class RegistrationCredentialService{


  /**
   * Descriptioon : use to get all data for view index
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Registration Credentials",
      "cardTitle" => "Registration Credentials",
      "registrationCredentials" => (new RegistrationCredentialRepository())->getAllDataRegistrationCredentialPaginated()
    ];
  }


  public function getCreateData():array
  {
    return [
      "title" => "Registration Credentials",
      "cardTitle" => "Registration Credentials",
      "roles" => (new RoleRepository())->getAllDataRole(),
      "credential" => Str::random(16)
    ];
  }

  public function storeNewData(array $requestedData)
  {
    return (new RegistrationCredentialRepository())->addNewDataRegistrationCredential($requestedData);
  }

  public function destroyData(int $id)
  {
    return (new RegistrationCredentialRepository())->deleteDataRegistrationCredentialById($id);
  }
}

?>