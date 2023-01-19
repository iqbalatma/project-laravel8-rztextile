<?php

namespace App\Services\Transactions;

use App\AppData;
use App\Repositories\InvoiceRepository;
use Iqbalatma\LaravelExtend\BaseService;

class InvoiceService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new InvoiceRepository();
    }
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        $type = request()->input("type", "all");
        $search = request()->input("search", false) ?? false;
        $monthYear = request()->input("month_year", false) ?? false;
        $month = false;
        $year = false;
        if ($monthYear) {
            $monthYear = explode("-", $monthYear);
            $month = $monthYear[1];
            $year = $monthYear[0];
        }

        return [
            "title"       => "Invoice",
            "description" => "Invoice transaction list",
            "cardTitle"   => "Invoices",
            "invoices"    => $this->repository->getAllDataInvoicePaginated(type: $type, search: $search, month: $month, year: $year),
        ];
    }

    public function reduceBill(int $invoiceId, int $paidAmount): void
    {
        $invoice = $this->repository->getDataInvoiceById($invoiceId);

        if ($paidAmount >= $invoice->bill_left) {
            $paidAmount = $invoice->bill_left;
            $invoice->is_paid_off = true;
        }
        $invoice->bill_left -= $paidAmount;
        $invoice->total_paid_amount += $paidAmount;
        $invoice->save();
    }

    public function download(int $id): array
    {
        return [
            "invoice"        => $this->repository->getDataInvoiceById($id),
            "companyName"    => AppData::COMPANY_NAME,
            "companyAddress" => AppData::COMPANY_ADDRESS,
            "companyPhone"   => AppData::COMPANY_PHONE,
            "companyEmail"   => AppData::COMPANY_EMAIL,
        ];
    }
}
