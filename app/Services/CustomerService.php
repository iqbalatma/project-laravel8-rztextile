<?php 
namespace App\Services;

use App\AppData;
use App\Repositories\CustomerRepository;

class CustomerService{

  private const ALL_CUSTOMER_SELECT_COLUMN = [
    "id", "name", "address", "phone", "role_id", "id_number", "updated_at"
  ];

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Customer",
      "cardTitle" => "Customers",
      "customers" => (new CustomerRepository())->getAllDataCustomerPaginated(self::ALL_CUSTOMER_SELECT_COLUMN)
    ];
  }


  /**
   * Description : use to get data for create form
   * 
   * @return array
   */
  public function getCreateData():array
  {
    return [
      "title" => "Customer",
      "cardTitle" => "Customers",
    ];
  }

  /**
   * Description : use to add new data 
   * 
   * @param array $requestedData
   */
  public function storeNewData(array $requestedData):?object
  {
    $requestedData["role_id"] = AppData::ROLE_ID_CUSTOMER;
    return (new CustomerRepository())->addNewDataCustomer($requestedData);
  }


  /**
   * Description : use to get data edit by id
   * 
   * @param int $id of customer that want to edit
   * @return array 
   */
  public function getEditData(int $id):array
  {
    return [
      "title" => "Customer",
      "cardTitle" => "Customers",
      "customer" => (new CustomerRepository())->getCustomerById($id, self::ALL_CUSTOMER_SELECT_COLUMN)
    ];
  }

  public function updateData(int $id, array $requestedData):bool
  {
    return (new CustomerRepository())->updateCustomerById($id, $requestedData);
  }

  public function deleteData(int $id):bool
  {
    return (new CustomerRepository())->deleteCustomerById($id);
  }

  
}

?>