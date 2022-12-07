<?php 
namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegistrationService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Registration",
    ];
  }


  /**
   * Description : use to add new data user
   * 
   * @param array $requestedData from clinet
   * @return ?object
   */
  public function storeNewData(array $requestedData)
  {
    $role_id = (new RegistrationCredentialService())->checkIsCredentialValid($requestedData["registration_credential"]);

    if(!$role_id){
      return false;
    }

    $requestedData["role_id"] = $role_id;
    $requestedData["password"] = Hash::make($requestedData["password"]);
    return (new UserRepository())->addNewDataUser($requestedData);
  }


}

?>