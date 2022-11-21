<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rolls\RollStoreRequest;
use App\Services\RollService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RollController extends Controller
{
    /**
     * Description : use to show all data rolls
     * 
     * @param RollService $service dependency injection
     * @return Response
     */
    public function index(RollService $service): Response
    {
        return response()->view("rolls.index", $service->getAllData());
    }


    /**
     * Description : use to show form for add new roll
     * 
     * @param RollService $service dependency injection
     * @return Response
     */
    public function create(RollService $service): Response
    {
        return response()->view("rolls.create", $service->getCreateData());
    }


    /**
     * Description : use to add new roll data
     * 
     * @param RollService $service dependency injection
     * @return RedirectResponse
     */
    public function store(RollService $service, RollStoreRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("rolls.index");

        $stored ?
            $redirect->with("success", "Add new data roll successfully") :
            $redirect->with("failed", "Add new data roll failed");

        return $redirect;
    }
}
