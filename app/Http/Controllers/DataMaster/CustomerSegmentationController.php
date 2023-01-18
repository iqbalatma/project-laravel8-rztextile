<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Services\DataMaster\CustomerSegmentationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerSegmentationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CustomerSegmentationService $service): Response
    {
        return response()->view("customer-segmentations.index", $service->getAllData());
    }
}
