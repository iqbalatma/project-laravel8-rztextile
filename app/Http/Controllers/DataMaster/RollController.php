<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rolls\RollPrintRequest;
use App\Http\Requests\Rolls\StoreRollRequest;
use App\Http\Requests\Rolls\UpdateRollRequest;
use App\Services\DataMaster\RollService;
use App\Services\DataMaster\UnitService;
use App\Services\Interfaces\DataMaster\IUnitService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RollController extends Controller
{

    /**
     * Description : use to show all data rolls
     *
     * @param RollService $service dependency injection
     * @return Response
     */
    public function index(RollService $service): Response
    {
        return response()->view("rolls.index", $service->getAllData());
    }


    /**
     * Description : use to show form for add new roll
     *
     * @param RollService $service dependency injection
     * @return Response
     */
    public function create(RollService $service): Response
    {
        return response()->view("rolls.create", $service->getCreateData());
    }


    /**
     * Description : use to show form for edit roll
     *
     * @param RollService $service dependency injection
     * @return Response
     */
    public function edit(RollService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getEditData($id);

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return response()->view("rolls.edit", $response);
    }


    /**
     * Description : use to update data roll
     *
     * @param RollService $service
     */
    public function update(RollService $service, UpdateRollRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateData($id, $request->validated());

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }
        return redirect()
            ->route("rolls.index")
            ->with("success", "Update data roll successfully");
    }


    /**
     * Description : use to add new roll data
     *
     * @param RollService $service dependency injection
     * @return RedirectResponse
     */
    public function store(RollService $service, StoreRollRequest $request): RedirectResponse
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("rolls.index");

        $stored ?
            $redirect->with("success", "Add new data roll successfully") :
            $redirect->with("failed", "Add new data roll failed");

        return $redirect;
    }

    /**
     * Description : use to download qrcode file
     *
     * @param string $qrcode
     * @return
     */
    public function downloadQrcode(string $qrcode): StreamedResponse
    {
        $headers = ['Content-Type: image/jpeg'];
        return Storage::download("public/images/qrcode/$qrcode", "qrcode.png", $headers);
    }

    public function printQrcode(RollService $service, RollPrintRequest $request)
    {

        $data = [
            "copies" => $request->only("copies")["copies"]
        ];
        $pdf = Pdf::loadView("PDF/qrcode", $data);
        $customPaper = array(0, 0, 302, 302);
        $pdf->set_paper($customPaper);
        return $pdf->stream("itsolutionstuff.pdf");
    }
}
