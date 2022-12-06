<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\RollTransaction;

class RollTransactionRepository{

  public function getAllDataRollTransactionPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return RollTransaction::with("invoice")
      ->select($columns)
      ->orderBy("created_at", "DESC")
      ->paginate($perPage)
      ->appends(request()->query());
  }

  public function getDataRollTransactionRestockPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return RollTransaction::with("invoice")
      ->select($columns)
      ->where("type", "restock")
      ->orderBy("created_at", "DESC")
      ->paginate($perPage)
      ->appends(request()->query());
  }


  public function getDataRollTransactionSoldPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return RollTransaction::with("invoice")
      ->select($columns)
      ->where("type", "sold")
      ->orderBy("created_at", "DESC")
      ->paginate($perPage)
      ->appends(request()->query());
  }


  public function getDataRollTransactionBrokenPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return RollTransaction::with("invoice")
      ->select($columns)
      ->where("type", "broken")
      ->orderBy("created_at", "DESC")
      ->paginate($perPage)
      ->appends(request()->query());
  }

  public function addNewDataRollTransaction(array $requestedData):?object
  {
    return RollTransaction::create($requestedData);
  }
}

?>