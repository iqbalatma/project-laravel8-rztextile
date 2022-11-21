<?php 
namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Repositories\UnitRepository;

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

  
}

?>