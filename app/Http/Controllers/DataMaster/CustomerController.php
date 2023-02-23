<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Services\DataMaster\CustomerService;
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
    public function index(CustomerService $service): Response
    {
        return response()->view("customers.index", $service->getAllData());
    }

    /**
     * Description : use to show add new customer form
     *
     * @param CustomerService $service dependency injection
     * @return Response
     */
    public function create(CustomerService $service): Response
    {
        return response()->view("customers.create", $service->getCreateData());
    }

    /**
     * Description : use to update data customer
     *
     * @param CustomerService $service dependency injection
     * @param StoreCustomerRequest $request dependency injection
     * @return RedirectResponse
     */
    public function store(CustomerService $service, StoreCustomerRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());


        $redirect = redirect()
            ->route("customers.index");

        $stored ?
            $redirect->with("success", "Add new data customer successfully") :
            $redirect->with("failed", "Add new data customer failed");

        return $redirect;
    }

    /**
     * Description : use to show form for edit data customer
     *
     * @param CustomerService $service dependency injection
     * @param int $id of customer that want to edit
     * @return Response
     */
    public function edit(CustomerService $service, int $id): Response
    {
        $response = $service->getEditData($id);

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return response()->view("customers.edit", $response);
    }

    /**
     * Description : use to update data into new data
     *
     * @param CustomerService $service dependency injection
     * @param UpdateCustomerRequest $request dependency injection
     * @param int $id of customer that want to update
     * @return RedirectResponse
     */
    public function update(CustomerService $service, UpdateCustomerRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateData($id, $request->validated());

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return redirect()
            ->route("customers.index")
            ->with("success", "Update data customer successfully");
    }

    /**
     * Description : use to delete data unit by id
     *
     * @param CustomerService $service dependency injection
     * @param int $id of unit that want to delete
     * @return RedirectResponse
     */
    public function destroy(CustomerService $service, int $id): RedirectResponse
    {
        $response = $service->deleteData($id);

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return redirect()
            ->route("customers.index")
            ->with("success", "Delete data customer successfully");
    }
}
