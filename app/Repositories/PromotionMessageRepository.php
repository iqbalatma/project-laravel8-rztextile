<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\PromotionMessage;

class PromotionMessageRepository{

  public function getAllDataPromotionMessagePaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return PromotionMessage::select($columns)
      ->paginate($perPage);
  }

  public function addNewDataPromotionMessage(array $requestedData)
  {
    return PromotionMessage::create($requestedData);
  }
}

?>