<?php 
namespace App\Services;

use App\AppData;
use App\Http\Traits\WablasTrait;
use App\Repositories\CustomerRepository;
use App\Repositories\PromotionMessageRepository;

class WhatsappMessagingService{
  private const GET_ALL_PROMOTION_MESSAGE_COLUMN = [
    AppData::TABLE_PROMOTION_MESSAGE.".id",
    AppData::TABLE_PROMOTION_MESSAGE.".name",
  ];

  public function getAllData():array
  {
    return [
      "title" => "Whatsapp Messaging",
      "cardTitle" => "Whatsapp Messaging",
      "customers" =>(new CustomerRepository())->getAllDataCustomer(),
      "promotionMessages" => (new PromotionMessageRepository())->getAllDataPromotionMessage(self::GET_ALL_PROMOTION_MESSAGE_COLUMN)
    ];
  }

  public function sendMessage(array $requestedData)
  {
    // $dataset = [];
    // $data['phone'] = $requestedData['phone'];
    // $data['message'] = $requestedData['message'];
    // $data['secret'] = false;
    // $data['retry'] = false;
    // $data['isGroup'] = false;
    // array_push($dataset, $data);

    dd("tes");
    WablasTrait::sendTextTest();
  }
}
