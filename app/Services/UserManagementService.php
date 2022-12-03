<?php 
namespace App\Services;


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
    ];
  }
}

?>