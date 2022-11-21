<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\User;

class CustomerRepository{

  public function getAllDataCustomerPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return User::with("role")
      ->select($columns)
      ->where("role_id", AppData::ROLE_ID_CUSTOMER)
      ->paginate($perPage);
  }


  public function addNewDataCustomer(array $requestedData):?object
  {
    return User::create($requestedData);
  }

  public function getCustomerById(int $id, array $columns = ["*"])
  {
    return User::find($id, $columns);
  }

  public function updateCustomerById(int $id, array $requestedData):bool
  {
    return User::where("id", $id)->update($requestedData);
  }

  public function deleteCustomerById(int $id):bool
  {
    return User::destroy($id);
  }
}

?>