<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Services\DataMaster\UserManagementService;
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
    public function index(UserManagementService $service): Response
    {
        return response()->view("users.index", $service->getAllData());
    }


    /**
     * Description : use to show add new user form
     *
     * @param UserManagementService $service dependency injection
     * @return Response
     */
    public function create(UserManagementService $service): Response
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
    public function store(UserManagementService $service, UserStoreRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("users.index");

        $stored ?
            $redirect->with("success", "Add new data user successfully") :
            $redirect->with("failed", "Add new data user failed");

        return $redirect;
    }


    /**
     * Description : use to show form for edit the data by id
     *
     * @param UserManagementService $service dependency injection
     * @param int $id of user
     * @return Response
     */
    public function edit(UserManagementService $service, int $id)
    {
        $response = $service->getEditData($id);
        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return response()->view("users.edit", $service->getEditData($id));
    }


    /**
     * Description : use to update data user by id
     *
     * @param UserManagementService $service dependency injection
     * @param UserUpdateRequest dependency injection
     * @param int $id of user that want to be edited
     * @return RedirectResponse
     */
    public function update(UserManagementService $service, UserUpdateRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateData($id, $request->validated());

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }
        return redirect()
            ->route("users.index")
            ->with("success", "Update data user successfully");
    }

    /**
     * Use to suspend an user
     * @param UserManagementService $service
     * @param int $id
     * @return RedirectResponse
     */
    public function changeStatusActive(UserManagementService $service, int $id): RedirectResponse
    {
        $response = $service->changeStatusById($id);

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return redirect()
            ->route("users.index")
            ->with("success", "Change status active user successfully");
    }
}
