<?php 
namespace App\Services;

use App\Repositories\PromotionMessageRepository;

class PromotionMessageService{

  /**
   * Description : use to get all data for index view
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Promotion Messages",
      "cardTitle" => "Promotion Messages",
      "promotionMessages" => (new PromotionMessageRepository())->getAllDataPromotionMessagePaginated()
    ];
  }


  /**
   * Description : use to get data for create view
   * 
   * @return array
   */
  public function getCreateData():array
  {
    return [
      "title" => "Promotion Messages",
      "cardTitle" => "Promotion Messages",
    ];
  }
}

?>