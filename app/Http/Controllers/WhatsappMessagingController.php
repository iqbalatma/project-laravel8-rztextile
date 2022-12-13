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

    // $payload =  [
    //     "data" => [
    //       [
    //         "phone" => "6282121438835",
    //         "message" => "test send \n ini adalah pesan dengan line break"
    //       ],
    //     ]
    //   ];

    // WablasTrait::sendMessage($payload);
  }
}
