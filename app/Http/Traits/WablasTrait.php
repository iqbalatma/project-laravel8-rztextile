<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;

trait WablasTrait
{
  public static function sendMessage($payload)
  {
    $token = config("wablas.token");
    $baseUrl = config("wablas.base_url");
    $client = new Client([
      "base_uri" => $baseUrl,
      "timeout" => 5,
      "headers" => [
        "Authorization" => $token,
        "Content-Type" => "application/json"
      ],

    ]);


  

    $response = $client->post("/api/v2/send-message",  ["body" => json_encode($payload)]);
    echo $response->getBody();
 
  }


  public static function sendTextTest()
  {
    $curl = curl_init();
    $token = env('WABLAS_SECURITY_TOKEN');
    $phone = "6282117416500";
    $message = "chat_dito_api";
    curl_setopt($curl, CURLOPT_URL, "https://jogja.wablas.com/api/send-message?phone=$phone&message=$message&token=$token");
    $result = curl_exec($curl);
    curl_close($curl);
    echo "<pre>";
    print_r($result);
  }
  public static function sendText2(array $data = [])
  {
    $curl = curl_init();
    $token = env('WABLAS_SECURITY_TOKEN');
    $payload = [
      "data" => $data
    ];

    curl_setopt(
      $curl,
      CURLOPT_HTTPHEADER,
      array(
        "Authorization: $token",
        "Content-Type: application/json"
      )
    );

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($curl, CURLOPT_URL,  env('WABLAS_DOMAIN_SERVER') . "/api/v2/send-message");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);
    print_r($result);
  }
}
