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
        $stored = $service->purchase($request->validated());

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
