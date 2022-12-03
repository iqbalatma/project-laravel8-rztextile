<?php

namespace App\Http\Controllers;

use App\Services\UserManagementService;
use Illuminate\Http\Response;

class UserManagementController extends Controller
{
    public function index(UserManagementService $service):Response
    {
        return response()->view("users.index", $service->getAllData());
    }
}
