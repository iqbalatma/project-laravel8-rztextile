<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Services\SegmentedCustomerService;
use Illuminate\Http\Response;

class SegmentedCustomerController extends Controller
{
    /**
     * To show view of segmented customer
     * @param SegmentedCustomerService $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SegmentedCustomerService $service): Response
    {
        return response()->view("segmented-customers.index", $service->getAllData());
    }
}
