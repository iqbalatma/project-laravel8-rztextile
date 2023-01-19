<?php

namespace App\Services\Transactions;

use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\RollRepository;
use Carbon\Carbon;
use Iqbalatma\LaravelExtend\BaseService;

class DashboardService extends BaseService
{
    private $invoiceRepo;
    private $rollRepo;
    private $paymentRepo;
    private $custRepo;

    public function __construct()
    {
        $this->invoiceRepo = new InvoiceRepository();
        $this->rollRepo = new RollRepository();
        $this->paymentRepo = new PaymentRepository();
        $this->custRepo = new CustomerRepository();
    }
    public function getAllData(): array
    {
        return [
            "title"           => "Dashboard",
            "description"     => "Transaction and finance summary chart and table",
            "total_invoices"  => $this->invoiceRepo->getTotalInvoiceMonthly(),
            "total_customer" =>  collect($this->custRepo->getAllData())->count(),
            "total_bill_left" => formatToRupiah($this->invoiceRepo->getTotalBillLeftMonthly()),
            "total_profit"    => formatToRupiah($this->invoiceRepo->getTotalProfitMonthly()),
            "total_capital"   => formatToRupiah($this->invoiceRepo->getTotalCapitalMonthly()),
            "currentMonth"    => Carbon::now()->format("F"),
            "latestInvoices"  => $this->invoiceRepo->getDataLatestInvoice(),
            "latestPayments"  => $this->paymentRepo->getDataLatestPayment(),
            "leastRolls"      => $this->rollRepo->getLeastRoll(),
        ];
    }
}
