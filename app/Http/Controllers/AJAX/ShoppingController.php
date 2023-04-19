<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shopping\PurchaseRequest;
use App\Services\AJAX\AjaxShoppingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Use to request purchase
     *
     * @param AjaxShoppingService $service
     * @param PurchaseRequest $request
     * @return JsonResponse
     */
    public function __invoke(AjaxShoppingService $service, PurchaseRequest $request): JsonResponse
    {
        $response = $service->purchase($request->validated());

        if ($this->isError($response))  return response()->json([
            "status"  => JsonResponse::HTTP_NOT_ACCEPTABLE,
            "message" => $response["message"],
            "error"   => true,
        ]);

        return response()->json([
            "status"  => JsonResponse::HTTP_OK,
            "message" => "Purchasing successfully",
            "error"   => false,
            "data"    => $response["invoice"]
        ]);
    }
}
