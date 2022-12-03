<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Services\UserManagementService;
use Illuminate\Http\RedirectResponse;
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


    /**
     * Description : use to show add new user form
     * 
     * @param UserManagementService $service dependency injection
     * @return Response
     */
    public function create(UserManagementService $service):Response
    {
        return response()->view("users.create", $service->getCreateData());
    }


    /**
     * Description : use to add new data user
     * 
     * @param UserManagementService $service dependency injection
     * @param StoreUserRequest $request dependency injection
     * @return RedirectResponse
     */
    public function store(UserManagementService $service, StoreUserRequest $request):RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());   

        $redirect = redirect()
            ->route("users.index");
            
        $stored?
            $redirect->with("success", "Add new data user successfully"):
            $redirect->with("failed", "Add new data user failed");

        return $redirect;
    }
}
