<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function index(DashboardService $service):Response
    {
        return response()->view("dashboard.index", $service->getAllData());
    }
}
