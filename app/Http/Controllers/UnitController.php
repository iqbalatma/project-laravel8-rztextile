<?php

namespace App\Http\Controllers;

use App\Http\Requests\Units\UnitUpdateRequest;
use App\Services\UnitService;
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
    public function index(UnitService $service):Response
    {
        return response()->view("units.index", $service->getAllData());
    }

    public function create(UnitService $service):Response
    {
        return response()->view("units.create", $service->getCreateData());
    }

    /**
     * Description : use to show edit form for unit by id
     * 
     * @param UnitService $service dependency injection
     * @param int $id of unit that want to edit
     */
    public function edit(UnitService $service, int $id):Response
    {
        return response()->view("units.edit", $service->getEditData($id));
    }


    /**
     * Description : use to update data unit with requested data
     * 
     * @param UnitService $service dependency injection
     * @param UnitUpdateRequest $request dependency injection
     * @param int $id of unit that want to update
     */
    public function update(UnitService $service, UnitUpdateRequest $request, int $id):RedirectResponse
    {
        $updated = $service->updateData($id, $request->validated());
        $return = redirect()
            ->route("units.index");
            
        $updated?
            $return->with("success", "Update data unit successfully"):
            $return->with("failed", "Update data unit failed");

        return $return;
    }
}
