<?php

namespace App\Http\Controllers;

use App\Services\InvoiceService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    /**
     * Description : use to show invoice view list
     * 
     * @param InvoiceService $service dependency injection
     * @return Response
     */
    public function index(InvoiceService $service):Response
    {
        return response()->view("invoices.index", $service->getAllData());
    }


    /**
     * Description : use to download invoice 
     * 
     * @param int $invoiceId that want to be download
     */
    public function downloadInvoice(InvoiceService $service, int $invoiceId):Response
    {
        $invoice = $service->download($invoiceId);
       
        $pdf = Pdf::loadView("PDF.invoice", $invoice);
        $pdf->set_paper("A5", 'landscape');
        return $pdf->download($invoice["invoice"]->code.".pdf");
    }
}
