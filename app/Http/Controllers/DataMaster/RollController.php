<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rolls\RollPrintRequest;
use App\Http\Requests\Rolls\StoreRollRequest;
use App\Http\Requests\Rolls\UpdateRollRequest;
use App\Services\DataMaster\RollService;
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
        viewShare($service->getAllData());
        return response()->view("rolls.index");
    }


    /**
     * Description : use to show form for add new roll
     *
     * @param RollService $service dependency injection
     * @return Response
     */
    public function create(RollService $service): Response
    {
        viewShare($service->getCreateData());
        return response()->view("rolls.create");
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

        viewShare($response);
        return response()->view("rolls.edit");
    }



    /**
     * Use to update data roll
     *
     * @param RollService $service
     * @param UpdateRollRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(RollService $service, UpdateRollRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

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
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("roles.index")->with("success", "Add new roll successfully");
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
