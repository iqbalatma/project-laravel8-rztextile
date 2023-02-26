<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\WhatsappMessaging\WhatsappMessagingStoreRequest;
use App\Services\CRM\WhatsappMessagingService;
use Illuminate\Http\Response;

class WhatsappMessagingController extends Controller
{
    public function index(WhatsappMessagingService $service): Response
    {
        return response()->view("whatsapp-messaging.index", $service->getAllData());
    }

    public function store(WhatsappMessagingService $service, WhatsappMessagingStoreRequest $request)
    {
        dd($request->validated());
        $sent = $service->sendMessage($request->validated());

        $redirect = redirect()
            ->route("whatsapp.messaging.index");

        $sent ?
            $redirect->with("success", "Send whatsapp message successfully") :
            $redirect->with("failed", "Send whatsapp message failed");

        return $redirect;
    }
}
