<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\Units\StoreUnitRequest;
use App\Http\Requests\Units\UpdateUnitRequest;
use App\Services\DataMaster\UnitService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UnitController extends Controller
{
    /**
     * Description : use to show all data unit
     *
     * @param UnitService $service dependency injection
     * @return Response for html view
     */
    public function index(UnitService $service): Response
    {
        return response()->view("units.index", $service->getAllData());
    }

    /**
     * Description : use to show form to add new unit
     *
     * @param UnitService $service dependency injection
     * @return Response
     */
    public function create(UnitService $service): Response
    {
        return response()->view("units.create", $service->getCreateData());
    }


    /**
     * Description : use to add new unit
     *
     * @param UnitService $service dependency injection
     * @param StoreUnitRequest $request dependency injection
     */
    public function store(UnitService $service, StoreUnitRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("units.index");

        $stored ?
            $redirect->with("success", "Add new data unit successfully") :
            $redirect->with("failed", "Add new data unit failed");

        return $redirect;
    }

    /**
     * Description : use to show edit form for unit by id
     *
     * @param UnitService $service dependency injection
     * @param int $id of unit that want to edit
     */
    public function edit(UnitService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getEditData($id);
        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return response()->view("units.edit", $response);
    }


    /**
     * Description : use to update data unit with requested data
     *
     * @param UnitService $service dependency injection
     * @param UpdateUnitRequest $request dependency injection
     * @param int $id of unit that want to update
     */
    public function update(UnitService $service, UpdateUnitRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateData($id, $request->validated());
        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return redirect()->route("units.index")->with("success", "Update data unit success fully !");
    }


    /**
     * Description : use to delete data unit by id
     *
     * @param UnitService $service dependency injection
     * @param int $id of unit that want to delete
     * @return RedirectResponse
     */
    public function destroy(UnitService $service, int $id): RedirectResponse
    {
        $response = $service->deleteData($id);
        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return redirect()
            ->route("units.index")
            ->with("success", "Delete data unit successfully");
    }
}
