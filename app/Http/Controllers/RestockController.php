<?php

namespace App\Http\Controllers;

use App\Http\Requests\Restock\RestockRequest;
use App\Services\RestockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RestockController extends Controller
{
    /**
     * Description : use to show form for restock data roll
     * 
     * @param RestockService $service
     * @return Response
     */
    public function create(RestockService $service):Response
    {
        return response()->view("restock.create", $service->getAllData());
    }

    public function store(RestockService $service, RestockRequest $request):RedirectResponse
    {
        $stored = $service->storeNewRestock($request->validated());

        $redirect = redirect()
            ->route("restock.create");
            
        $stored?
            $redirect->with("success", "Restock new roll successfully"):
            $redirect->with("failed", "Restock new roll failed");

        return $redirect;
    }
}
