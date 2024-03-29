<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Services\AJAX\AjaxPromotionMessageService;
use Illuminate\Http\JsonResponse;

class PromotionMessageController extends Controller
{
    public function show(AjaxPromotionMessageService $service, int $id): JsonResponse
    {
        $data = $service->getShowData($id);
        return response()->json([
            "message" => "Get promotion message by id successfully",
            "status"  => JsonResponse::HTTP_OK,
            "error"   => 0,
            "data"    => $data
        ]);
    }

    public function getByCustomerSegmentation(AjaxPromotionMessageService $service, int $id): JsonResponse
    {
        $data = $service->getDataByCustomerSegmentationId($id);
        return response()->json([
            "message" => "Get promotion message by customer segmentation id successfully",
            "status"  => JsonResponse::HTTP_OK,
            "error"   => 0,
            "data"    => $data
        ]);
    }
}
