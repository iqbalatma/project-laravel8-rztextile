<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\RollTransactions\StoreRollTransactionRequest;
use App\Services\Stock\RollTransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RollTransactionController extends Controller
{
    /**
     * Description : use to show all data roll transaction
     *
     * @param RollTransactionService $service dependency injection
     * @return Response
     */
    public function index(RollTransactionService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("roll-transactions.index");
    }


    /**
     * Show form for restock and deadstock
     * @param RollTransactionService $service
     * @return \Illuminate\Http\Response
     */
    public function create(RollTransactionService $service): Response
    {
        viewShare($service->getCreateData());
        return response()->view("roll-transactions.create");
    }


    /**
     * Add new roll transaction
     * @param RollTransactionService $service
     * @param StoreRollTransactionRequest $request
     * @return RedirectResponse
     */
    public function store(RollTransactionService $service, StoreRollTransactionRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        $message = $request->input("type") == "restock" ?
            "Restock" :
            "Deadstock";

        return redirect()->back()->with("success", "$message roll successfully");
    }
}
