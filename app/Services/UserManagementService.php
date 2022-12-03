<?php 
namespace App\Services;

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


}

?>