<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Services\AJAX\AjaxDashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __invoke(AjaxDashboardService $service): JsonResponse
    {
        $data = $service->getSummarySalesData();
        return response()->json([
            "message" => "Get sales summary successfully",
            "status" => JsonResponse::HTTP_OK,
            "error" => false,
            "data" => $data
        ]);
    }
}
