<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shopping\PurchaseRequest;
use App\Services\Transactions\ShoppingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ShoppingController extends Controller
{
    public function index(ShoppingService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("shopping.index");
    }

    public function purchase(ShoppingService $service, PurchaseRequest $request): JsonResponse
    {
        $stored = $service->purchase($request->validated());

        return response()->json([$stored]);
        if ($stored) {
            return response()->json([
                "status"  => JsonResponse::HTTP_OK,
                "message" => "Purchasing successfully",
                "error"   => false,
                "data"    => $stored
            ]);
        } else {
            return response()->json([
                "status"  => JsonResponse::HTTP_NOT_ACCEPTABLE,
                "message" => "Something went wrong",
                "error"   => true,
            ]);
        }
    }
}
