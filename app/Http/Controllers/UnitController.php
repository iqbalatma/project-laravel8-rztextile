<?php

namespace App\Http\Controllers;

use App\Http\Requests\Units\UnitUpdateRequest;
use App\Services\UnitService;
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

    public function update(UnitService $service, UnitUpdateRequest $request, int $id)
    {
        $updated = $service->updateData($id, $request->validated());
        $return = redirect()
            ->route("units.index");
            
        if($updated){
            $return->with("success", "Update data unit successfully");
        }else{
            $return->with("failed", "Update data unit failed");
        }
        
        return $return;
    }
}
