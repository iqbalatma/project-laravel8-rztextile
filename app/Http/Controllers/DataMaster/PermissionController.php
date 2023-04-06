<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Services\DataMaster\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{

    /**
     * Use to show index view
     *
     * @param PermissionService $service
     * @return Response
     */
    public function index(PermissionService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("permissions.index");
    }
}
