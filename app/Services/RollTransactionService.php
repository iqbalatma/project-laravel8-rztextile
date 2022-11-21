<?php

namespace App\Services;

use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;
use App\Repositories\UnitRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class RollTransactionService
{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData(): array
  {
    return [
      "title" => "Roll Transaction",
      "cardTitle" => "Roll Transactions",
      "rollTransactions" => (new RollTransactionRepository())->getAllDataRollTransactionPaginated()
    ];
  }

  public function getPutAwayData(): array
  {
    return [
      "title" => "Put Away",
      "cardTitle" => "Put Away",
      "rolls" => (new RollRepository())->getAllDataRoll()
    ];
  }

  public function addNewPutAwayTransaction(array $requestedData): ?object
  {
    $requestedData["type"] = "broken";
    $requestedData["user_id"] = 1; #DUMMY

    try {
      DB::beginTransaction();

      //!NEED TO CHECK THE QUANTITY FIRST BEFORE ADD NEW QUANTITY

      (new RollRepository())->decreaseQuantityRollAndUnit(
        $requestedData["roll_id"],
        $requestedData["quantity_roll"],
        $requestedData["quantity_unit"]
      );

      $rollTransaction =  (new RollTransactionRepository())->addNewDataRollTransaction($requestedData);
      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
    }
    return $rollTransaction;
  }
}
