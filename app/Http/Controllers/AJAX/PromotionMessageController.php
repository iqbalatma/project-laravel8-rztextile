<?php

namespace App\Http\Controllers\AJAX;

use App\Http\Controllers\Controller;
use App\Services\AjaxDashboardService;
use App\Services\AjaxPromotionMessageService;
use Illuminate\Http\JsonResponse;

class PromotionMessageController extends Controller
{
    public function show(AjaxPromotionMessageService $service, int $id)
    {
        $data = $service->getShowData($id);

        return response()->json(["data" => "tes"]);
    }
}
