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


  public function storeNewData(array $requestedData):?object
  {
    $requestedData["role_id"] = AppData::ROLE_ID_CUSTOMER;
    return (new CustomerRepository())->addNewDataCustomer($requestedData);
  }

  
}

?>