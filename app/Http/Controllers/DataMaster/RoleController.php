<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Description : use to show all data roles
     *
     * @param RoleService $service dependency injection
     */
    public function __invoke(RoleService $service): Response
    {
        return response()->view("roles.index", $service->getAllData());
    }
}
