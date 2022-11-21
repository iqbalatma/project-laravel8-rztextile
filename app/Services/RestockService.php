<?php 
namespace App\Services;

use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;

class RestockService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Restock",
      "cardTitle" => "Restock",
      "rolls" => (new RollRepository())->getAllDataRoll()
    ];
  }

  public function storeNewRestock(array $requestedData)
  {
    $requestedData["type"] = "restock";
    $requestedData["user_id"] = 1; #DUMMY

    return (new RollTransactionRepository())->addNewDataRollTransaction($requestedData);
  }

}

?>