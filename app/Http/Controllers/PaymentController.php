<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function index(PaymentService $service)
    {
        return response()->view("payments.index", $service->getAllData());
    }
}
