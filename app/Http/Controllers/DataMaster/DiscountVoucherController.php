<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountVouchers\StoreDiscountVoucherRequest;
use App\Services\DataMaster\DiscountVoucherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DiscountVoucherController extends Controller
{
    /**
     * Use to get list discount voucher
     *
     * @param DiscountVoucherService $service
     * @return Response
     */
    public function index(DiscountVoucherService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("discount-vouchers.index");
    }


    /**
     * Use to show form add
     *
     * @param DiscountVoucherService $service
     * @return Response
     */
    public function create(DiscountVoucherService $service): Response
    {
        viewShare($service->getCreateData());
        return response()->view("discount-vouchers.create");
    }


    /**
     * Use to add new data
     *
     * @param DiscountVoucherService $service
     * @param StoreDiscountVoucherRequest $request
     * @return RedirectResponse
     */
    public function store(DiscountVoucherService $service, StoreDiscountVoucherRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("discount.vouchers.index")->with("success", "Add new discount voucher successfully");
    }

    public function changeValidateStatus(DiscountVoucherService $service, int $id, string $status)
    {
        $response = $service->updateStatusById($id, $status);
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("discount.vouchers.index")->with("success", "Change status discount voucher successfully");
    }
}
