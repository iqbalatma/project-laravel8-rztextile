<?php 
namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class UserManagementService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "User Management",
      "cardTitle" => "User Management",
      "users" => (new UserRepository())->getAllDataUserPaginated()
    ];
  }


  /**
   * Description : use to get data for create new user form
   * 
   * @return array
   */
  public function getCreateData():array
  {
    return [
      "title" => "User Management",
      "cardTitle" => "Add New User",
      "roles" => (new RoleRepository())->getAllDataRole()
    ];
  }


}

?>