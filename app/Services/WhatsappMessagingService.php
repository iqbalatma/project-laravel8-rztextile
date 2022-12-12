<?php 
namespace App\Services;

use App\Http\Traits\WablasTrait;

class WhatsappMessagingService{
  public function getAllData():array
  {
    return [
      "title" => "Whatsapp Messaging",
      "cardTitle" => "Whatsapp Messaging"
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
?>