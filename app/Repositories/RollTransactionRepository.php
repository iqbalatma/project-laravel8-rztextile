<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\RollTransaction;

class RollTransactionRepository{

  public function getAllDataRollTransactionPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return RollTransaction::select($columns)
      ->paginate($perPage);
  }
}

?>