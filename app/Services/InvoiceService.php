<?php
namespace App\Services;

use App\AppData;
use App\Repositories\InvoiceRepository;

class InvoiceService
{

    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        $type = request("type") ?? "all";
        $invoices = null;

        switch ($type) {
            case "paid-off":
                $invoices = (new InvoiceRepository())->getPaidOffDataInvoicePaginated();
                break;
            case "not-paid-off":
                $invoices = (new InvoiceRepository())->getNotPaidOffDataInvoicePaginated();
                break;
            default:
                $invoices = (new InvoiceRepository())->getAllDataInvoicePaginated();
        }

        return [
            "title"       => "Invoice",
            "description" => "Invoice transaction list",
            "cardTitle"   => "Invoices",
            "type"        => $type,
            "invoices"    => $invoices
        ];
    }

    public function reduceBill(int $invoiceId, int $paidAmount): void
    {
        $invoice = (new InvoiceRepository())->getDataInvoiceById($invoiceId);

        if ($paidAmount >= $invoice->bill_left) {
            $paidAmount = $invoice->bill_left;
            $invoice->is_paid_off = true;
        }
        $invoice->bill_left -= $paidAmount;
        $invoice->total_paid_amount += $paidAmount;
        $invoice->save();
    }

    public function download(int $invoiceId)
    {
        $invoice = (new InvoiceRepository())->getDataInvoiceById($invoiceId);
        return [
            "invoice"        => $invoice,
            "companyName"    => AppData::COMPANY_NAME,
            "companyAddress" => AppData::COMPANY_ADDRESS,
            "companyPhone"   => AppData::COMPANY_PHONE,
            "companyEmail"   => AppData::COMPANY_EMAIL,
        ];
    }
}

?>
