<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\DashboardService;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Show dashboard summary for transaction and finance
     * @param DashboardService $service
     * @return Response
     */
    public function __invoke(DashboardService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("dashboard.index");
    }
}
