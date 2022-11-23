<?php

namespace App\Http\Controllers;

use App\Services\ShoppingService;
use Illuminate\Http\Response;

class ShoppingController extends Controller
{
    public function index(ShoppingService $service):Response
    {
        return response()->view("shopping.index", $service->getAllData());
    }
}
