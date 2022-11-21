<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{

    /**
     * Description : use to show all data customer
     * 
     * @return Response
     */
    public function index(CustomerService $service):Response
    {
        return response()->view("customers.index", $service->getAllData());
    }
}
