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


  /**
   * Description : use to get data for create new user form
   * 
   * @param int $id of user that want to be edited
   * @return array
   */
  public function getEditData(int $id):array
  {
    return [
      "title" => "User Management",
      "cardTitle" => "Edit User",
      "roles" => (new RoleRepository())->getAllDataRole(),
      "user" => (new UserRepository())->getDataUserById($id)
    ];
  }


  /**
   * Description : use to add new data user
   * 
   * @param array $requestedDatata
   * @return ?object of new eloquent instance
   */
  public function storeNewData(array $requestedData):?object
  {
    return (new UserRepository())->addNewDataUser($requestedData);
  }

  public function updateData(int $id, array $requestedData):bool
  {
    return (new UserRepository())->updateDataUserById($id, $requestedData);
  }


}

?>