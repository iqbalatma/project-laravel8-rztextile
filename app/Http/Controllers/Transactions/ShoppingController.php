<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shopping\PurchaseRequest;
use App\Services\Transactions\ShoppingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ShoppingController extends Controller
{
    /**
     * Use to show index shopping
     *
     * @param ShoppingService $service
     * @return Response
     */
    public function __invoke(ShoppingService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("shopping.index");
    }
}
