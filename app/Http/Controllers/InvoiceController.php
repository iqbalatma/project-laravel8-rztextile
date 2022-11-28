<?php

namespace App\Http\Controllers;

use App\Services\InvoiceService;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    public function index(InvoiceService $service):Response
    {
        return response()->view("invoices.index", $service->getAllData());
    }
}
