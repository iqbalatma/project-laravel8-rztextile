<?php

namespace App\Http\Controllers;

use App\Services\WhatsappMessagingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Traits\WablasTrait;

class WhatsappMessagingController extends Controller
{
    public function index(WhatsappMessagingService $service): Response
    {
        return response()->view("whatsapp-messaging.index", $service->getAllData());
    }

    public function store(WhatsappMessagingService $service, Request $request)
    {
        $curl = curl_init();
        $token = "bLxBueXyQcKoJbTR1L5HR7Q05AGORzumIpoXukfUhxjzm8LkbHmSDJLPQ0FVxhMm";
        $phone = "6289678475252";
        $message = "test-message-from-api-wablas";
        curl_setopt($curl, CURLOPT_URL, "https://jogja.wablas.com/api/send-message?phone=$phone&message=$message&token=$token");

        $result = curl_exec($curl);
        curl_close($curl);
        echo "<pre>";
        print_r($result);
        dd($result);

        $curl = curl_init();
        $token = "bLxBueXyQcKoJbTR1L5HR7Q05AGORzumIpoXukfUhxjzm8LkbHmSDJLPQ0FVxhMm";
        $data = [
            'phone' => '6282121438835',
            'message' => 'test wa blas method post',
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL,  "https://jogja.wablas.com/api/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        echo "<pre>";
        print_r($result);
    }
}
