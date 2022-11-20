<?php 
namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Role",
      "cardTitle" => "Roles",
      "roles" => (new RoleRepository())->getAllDataRolePaginated()
    ];
  }
}

?>