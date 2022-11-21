<?php 
namespace App\Services;

use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;
use App\Repositories\UnitRepository;

class RollTransactionService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Roll Transaction",
      "cardTitle" => "Roll Transactions",
      "rollTransactions" => (new RollTransactionRepository())->getAllDataRollTransactionPaginated()
    ];
  }

  public function getPutAwayData():array
  {
    return [
      "title" => "Put Away",
      "cardTitle" => "Put Away",
      "rolls" => (new RollRepository())->getAllDataRoll()
    ];
  }

  public function addNewPutAwayTransaction(array $requestedData):?object
  {
    $requestedData["type"] = "broken";
    $requestedData["user_id"] = 1; #DUMMY
    return (new RollTransactionRepository())->addNewDataRollTransaction($requestedData);
  }

}

?>