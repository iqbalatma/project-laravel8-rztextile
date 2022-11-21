<?php

namespace App\Http\Controllers;

use App\Services\RollTransactionService;
use Illuminate\Http\Response;

class RollTransactionController extends Controller
{
    public function index(RollTransactionService $service):Response
    {
        return response()->view("roll-transactions.index", $service->getAllData());
    }
}
