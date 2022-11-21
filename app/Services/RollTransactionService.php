<?php 
namespace App\Services;

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

}

?>