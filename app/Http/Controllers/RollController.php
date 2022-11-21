<?php

namespace App\Http\Controllers;

use App\Services\RollService;
use Illuminate\Http\Response;

class RollController extends Controller
{
    /**
     * Description : use to show all data rolls
     * 
     * @param RollService $service dependency injection
     * @return Response
     */
    public function index(RollService $service):Response
    {
        return response()->view("rolls.index", $service->getAllData());
    }


    /**
     * Description : use to show form for add new roll
     */
    public function create(RollService $service):Response
    {
        return response()->view("rolls.create", $service->getCreateData());
    }
}
