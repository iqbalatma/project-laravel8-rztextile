<?php

namespace App\Contracts\Abstracts;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\RollTransaction;
use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\RollRepository;
use App\Services\Transactions\PaymentService;
use App\Statics\Tables;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

abstract class BaseShoppingService extends BaseService
{
    protected $rollRepo;
    protected $custRepo;
    protected $paymentRepo;
    protected $invoiceRepo;
    protected $paymentService;
    private array $requestedRolls;
    private Collection $dataRolls;
    private Invoice $invoice;

    public function __construct()
    {
        $this->rollRepo = new RollRepository();
        $this->custRepo = new CustomerRepository();
        $this->paymentRepo = new PaymentRepository();
        $this->paymentService = new PaymentService();
        $this->invoiceRepo = new InvoiceRepository();
    }

    protected const ALL_ROLL_SELECT_COLUMN = [
        Tables::TABLE_ROLL . ".id",
        Tables::TABLE_ROLL . ".name",
        Tables::TABLE_ROLL . ".code",
        Tables::TABLE_ROLL . ".quantity_roll",
        Tables::TABLE_ROLL . ".quantity_unit",
        Tables::TABLE_ROLL . ".basic_price",
        Tables::TABLE_ROLL . ".selling_price",
        Tables::TABLE_ROLL . ".unit_id",
        Tables::TABLE_ROLL . ".qrcode",
    ];

    protected const ALL_CUSTOMER_SELECT_COLUMN = [
        Tables::TABLE_USER . ".id",
        Tables::TABLE_USER . ".id_number",
        Tables::TABLE_USER . ".name",
        Tables::TABLE_USER . ".address",
        Tables::TABLE_USER . ".phone",
    ];

    /**
     * Description : use to add new paymen when paid amount more than 0
     *
     * @param array $requestedData from client request
     * @return Payment
     */
    protected function addNewPayment(array $requestedData): Payment
    {
        $invoiceId = $this->getInvoice()->id;
        $dataPayment = [
            "code"         => $this->paymentService->getGeneratedPaymentCode(),
            "paid_amount"  => $requestedData["paid_amount"],
            "payment_type" => $requestedData["payment_type"],
            "invoice_id"   => $invoiceId,
            "user_id"      => Auth::user()->id,
        ];
        if ($requestedData["paid_amount"] >= $requestedData["total_bill"]) {
            $dataPayment["paid_amount"] = $requestedData["total_bill"];
        }
        return $this->paymentRepo->addNewData($dataPayment);
    }

    /**
     * Description : use to add new invoice data
     *
     * @param array $requestedData from client
     * @return void
     */
    protected function addNewInvoice(array $requestedData): void
    {
        $totalCapital = $this->getTotalCapital($requestedData["rolls"]);
        $dataInvoice = [
            "code"              => $this->getGeneratedInvoiceCode(),
            "is_paid_off"       => false,
            "total_capital"     => $totalCapital,
            "total_bill"        => $requestedData["total_bill"],
            "final_bill"        => $requestedData["final_bill"],
            "discount_amount" => $requestedData["total_bill"] - $requestedData["final_bill"],
            "voucher_id" => $requestedData["voucher_id"] ?? null,
            "total_paid_amount" => $requestedData["paid_amount"],
            "bill_left"         => $requestedData["final_bill"] - $requestedData["paid_amount"],
            "total_profit"      => $requestedData["final_bill"] - $totalCapital,
            "customer_id"       => $requestedData["customer_id"],
            "user_id"           => Auth::user()->id,
        ];

        // use to custom date
        if ($requestedData["custom_date"]) {
            $dataInvoice["created_at"] = $requestedData["custom_date"];
            $dataInvoice["updated_at"] = $requestedData["custom_date"];
        }

        if ($requestedData["paid_amount"] >= $requestedData["final_bill"]) {
            $dataInvoice["total_paid_amount"] = $requestedData["final_bill"];
            $dataInvoice["bill_left"] = 0;
            $dataInvoice["is_paid_off"] = true;
        }

        $this->setInvoice($this->invoiceRepo->addNewData($dataInvoice));
    }


    /**
     * Description : use to generate invoice code with year, month, and
     * Description: use to add new data roll transaction
     *
     * @param int $invoice id
     */
    protected function addNewRollTransaction(): void
    {
        $dataTransaction = $this->getRequestedRolls();
        $rolls = $this->getDataRolls();
        $invoiceId = $this->getInvoice()->id;
        $now = Carbon::now();

        foreach ($dataTransaction as $key => $item) {
            $dataTransaction[$key]["type"] = "sold";
            $dataTransaction[$key]["user_id"] = Auth::user()->id;
            $dataTransaction[$key]["invoice_id"] = $invoiceId;

            $dataTransaction[$key]["capital"] = 0;
            $dataTransaction[$key]["created_at"] = $now;
            $dataTransaction[$key]["updated_at"] = $now;
            foreach ($rolls as $subItem) {
                if ($subItem->id == $item["roll_id"]) {
                    $dataTransaction[$key]["capital"] = $subItem->basic_price * $item["quantity_unit"];
                }
            }
            $dataTransaction[$key]["profit"] = $dataTransaction[$key]["sub_total"] - $dataTransaction[$key]["capital"];
            unset($dataTransaction[$key]["sub_total"]);
        }

        RollTransaction::insert($dataTransaction);
    }

    /** number
     *
     * @return string of generated invoice code
     */
    protected function getGeneratedInvoiceCode(): string
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $newCode = "INV-$year-$month-";
        $dataInvoice = $this->invoiceRepo->getLatestDataInvoiceThisMonth();

        if ($dataInvoice) {
            $code = $dataInvoice->code;
            $code = explode('-', $code);
            $lastNumber = end($code);
            $newCode .= getIncreasedDigitNumber($lastNumber);
        } else {
            $newCode .= "0001";
        }
        return $newCode;
    }

    /**
     * Description : use to get total capital base on request and basic price from database
     *
     * @param array $requestedRolls from client
     * @return int $totalCapital
     */
    public function getTotalCapital(array $requestedRolls): int
    {
        $totalCapital = 0;
        $rolls = $this->getDataRolls();
        foreach ($requestedRolls as $roll) {
            foreach ($rolls as $item) {
                if ($roll["roll_id"] == $item->id) {
                    $totalCapital += $item->basic_price * $roll["quantity_unit"];
                }
            }
        }

        return $totalCapital;
    }

    /**
     * Decsription : use to reduce all data quantity roll and unit
     *
     * @param array $requestedData from client
     */
    protected function reduceQuantityRollAndUnit(): void
    {
        foreach ($this->getRequestedRolls() as $roll) {
            $this->rollRepo->decreaseQuantityRollAndUnit(
                $roll["roll_id"],
                $roll["quantity_roll"],
                $roll["quantity_unit"]
            );
        }
    }


    /**
     * Use as getter for requested rolls
     *
     * @return array
     */
    protected function getRequestedRolls(): array
    {
        return $this->requestedRolls;
    }


    /**
     * Use as setter for requested roll
     *
     * @param array $requestedRolls
     * @return void
     */
    protected function setRequestedRolls(array $requestedRolls): void
    {
        $this->requestedRolls = $requestedRolls;
    }

    /**
     * Use to getter for data rolls
     *
     * @return Collection
     */
    protected function getDataRolls(): Collection
    {
        return $this->dataRolls;
    }


    /**
     * Use as setter data rolls
     *
     * @param Collection $dataRolls
     * @return void
     */
    protected function setDataRolls(Collection $dataRolls): void
    {
        $this->dataRolls = $dataRolls;
    }


    /**
     * Use as invoice getter
     *
     * @return Invoice
     */
    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    /**
     * Use as invoice setter
     *
     * @param Invoice $invoice
     * @return void
     */
    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }
}
