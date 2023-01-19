<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Services\AJAX\AjaxDiscountVoucherService;
use Illuminate\Http\JsonResponse;

class DiscountVoucherController extends Controller
{
    public function __invoke(AjaxDiscountVoucherService $service, string $code): JsonResponse
    {
        $data = $service->checkVoucherCode($code);
        if ($data) {
            return response()->json([
                "message" => "Get voucher by code successfully",
                "status"  => JsonResponse::HTTP_OK,
                "error"   => 0,
                "data"    => $data
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Get voucher by code failed ",
                "status"  => JsonResponse::HTTP_NOT_FOUND,
                "error"   => 1,
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
