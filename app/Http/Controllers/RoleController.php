<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    /**
     * Description : use to show all data role
     *
     * @param RoleService $service dependency injection
     */
    public function __invoke(RoleService $service): Response
    {
        return response()->view("roles.index", $service->getAllData());
    }
}
