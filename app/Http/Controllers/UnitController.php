<?php

namespace App\Http\Controllers;

use App\Services\UnitService;
use Illuminate\Http\Response;

class UnitController extends Controller
{
    /**
     * Description : use to show all data unit
     * 
     * @return Response for html view
     */
    public function index(UnitService $service):Response
    {
        return response()->view("units.index", $service->getAllData());
    }
}
