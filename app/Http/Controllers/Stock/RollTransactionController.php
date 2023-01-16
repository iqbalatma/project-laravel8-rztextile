<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\RollTransactions\StoreRollTransactionRequest;
use App\Services\Stock\RollTransactionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        return response()->view("roll-transactions.index", $service->getAllData());
    }


    /**
     * Show form for restock and deadstock
     * @param RollTransactionService $service
     * @return \Illuminate\Http\Response
     */
    public function create(RollTransactionService $service): Response
    {
        return response()->view("roll-transactions.create", $service->getCreateData());
    }


    /**
     * Add new roll transaction
     * @param RollTransactionService $service
     * @param StoreRollTransactionRequest $request
     * @return RedirectResponse
     */
    public function store(RollTransactionService $service, StoreRollTransactionRequest $request): RedirectResponse
    {
        $stored = $service->addNewData($request->validated());

        $redirect = redirect()
            ->route("roll.transactions.create");

        $message = $request->input("type") == "restock" ?
            "Restock" :
            "Deadstock";

        $stored ?
            $redirect->with("success", "$message roll successfully") :
            $redirect->with("failed", "$message roll failed");

        return $redirect;
    }
}
