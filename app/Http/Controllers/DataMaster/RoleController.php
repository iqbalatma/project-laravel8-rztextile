<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Services\DataMaster\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Description : use to show all data roles
     *
     * @param RoleService $service dependency injection
     */
    public function index(RoleService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("roles.index");
    }

    /**
     * Use to show create form
     *
     * @param RoleService $service
     * @return Response
     */
    public function create(RoleService $service): Response
    {
        viewShare($service->getCreateData());
        return response()->view("roles.create");
    }

    /**
     * Use to add new data role
     *
     * @param RoleService $service
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleService $service, StoreRoleRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response, "roles.create")) return $this->getErrorResponse();

        return redirect()->route("roles.index")->with("success", "Add new role successfully");
    }
}
