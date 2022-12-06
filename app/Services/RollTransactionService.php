<?php

namespace App\Services;

use App\Exceptions\InvalidActionException;
use App\Repositories\RollRepository;
use App\Repositories\RollTransactionRepository;
use App\Repositories\UnitRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
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
    $type = request("type", "all");

    switch ($type) {
      case "broken":
        $rollTransactions = (new RollTransactionRepository())->getDataRollTransactionBrokenPaginated();
        break;
      case "sold":
        $rollTransactions = (new RollTransactionRepository())->getDataRollTransactionSoldPaginated();
        break;
      case "restock":
        $rollTransactions = (new RollTransactionRepository())->getDataRollTransactionRestockPaginated();
        break;
      default:
        $rollTransactions = (new RollTransactionRepository())->getAllDataRollTransactionPaginated();
    }
    return [
      "title" => "Roll Transaction",
      "cardTitle" => "Roll Transactions",
      "type" => $type,
      "rollTransactions" => $rollTransactions
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
    $requestedData["user_id"] = Auth::user()->id;

    try {
      DB::beginTransaction();
      $rollRepository = new RollRepository();

      $roll = $rollRepository->getDataRollById($requestedData["roll_id"]);
      
      if($requestedData["quantity_roll"]>$roll->quantity_roll || $requestedData["quantity_unit"]>$roll->quantity_unit ){
        throw new InvalidActionException("Roll quantity or quantity unit cannot bigger than stock on warehouse");
      }

      $rollRepository->decreaseQuantityRollAndUnit(
        $requestedData["roll_id"],
        $requestedData["quantity_roll"],
        $requestedData["quantity_unit"]
      );

      $rollTransaction =  (new RollTransactionRepository())->addNewDataRollTransaction($requestedData);
      DB::commit();
    } catch (Exception $e) {
      DB::rollBack();
      throw $e;
    }
    return $rollTransaction;
  }
}
