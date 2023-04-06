<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
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

    /**
     * Use to delete role
     *
     * @param RoleService $service
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(RoleService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->route("roles.index")->with("success", "Delete role successfully");
    }

    /**
     * Use to show form edit for role
     *
     * @param RoleService $service
     * @param integer $id
     * @return Response|RedirectResponse
     */
    public function edit(RoleService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getEditData($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("roles.edit");
    }


    /**
     * use to update data role by id
     *
     * @param RoleService $service
     * @param UpdateRoleRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(RoleService $service, UpdateRoleRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->route("roles.index")->with("success", "Update data role successfully");
    }
}
