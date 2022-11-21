<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\CustomerStoreRequest;
use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CustomerController extends Controller
{

    /**
     * Description : use to show all data customer
     * 
     * @param CustomerService $service dependency injection
     * @return Response
     */
    public function index(CustomerService $service):Response
    {
        return response()->view("customers.index", $service->getAllData());
    }


    /**
     * Description : use to show add new customer form
     * 
     * @param CustomerService $service dependency injection
     * @return Response
     */
    public function create(CustomerService $service):Response
    {
        return response()->view("customers.create", $service->getCreateData());
    }

    public function store(CustomerService $service, CustomerStoreRequest $request):RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("customers.index");
            
        $stored?
            $redirect->with("success", "Add new data customer successfully"):
            $redirect->with("failed", "Add new data customer failed");

        return $redirect;
    }
}
