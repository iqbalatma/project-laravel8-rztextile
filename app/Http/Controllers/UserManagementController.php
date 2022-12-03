<?php

namespace App\Http\Controllers;

use App\Services\UserManagementService;
use Illuminate\Http\Response;

class UserManagementController extends Controller
{

    /**
     * Description : use to show user management index view
     * 
     * @param UserManagementServcie $service dependency injection
     * @return Response
     */
    public function index(UserManagementService $service):Response
    {
        return response()->view("users.index", $service->getAllData());
    }
}
