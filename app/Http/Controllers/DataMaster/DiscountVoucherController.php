<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Services\DataMaster\DiscountVoucherService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DiscountVoucherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DiscountVoucherService $service): Response
    {
        return response()->view("discount-vouchers.index", $service->getAllData());
    }
}
