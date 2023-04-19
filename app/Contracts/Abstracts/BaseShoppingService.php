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
        $dataPayment = [
            "code"         => $this->paymentService->getGeneratedPaymentCode(),
            "paid_amount"  => $requestedData["paid_amount"],
            "payment_type" => $requestedData["payment_type"],
            "invoice_id"   => $this->getInvoice()->id,
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
        if (isset($requestedData["custom_date"])) {
            $dataInvoice["created_at"] = $requestedData["custom_date"];
            $dataInvoice["updated_at"] = $requestedData["custom_date"];
        }

        // use to se paid amount and bill left calculation
        if ($requestedData["paid_amount"] >= $requestedData["final_bill"]) {
            $dataInvoice["total_paid_amount"] = $requestedData["final_bill"];
            $dataInvoice["bill_left"] = 0;
            $dataInvoice["is_paid_off"] = true;
        }

        $invoice = $this->invoiceRepo->addNewData($dataInvoice);
        $this->setInvoice($invoice);
    }


    /**
     * Description : use to generate invoice code with year, month, and
     * Description: use to add new data roll transaction
     *
     * @param int $invoice id
     */
    protected function addNewRollTransaction(): void
    {
        $rolls = $this->getDataRolls();
        $rollTransaction =  collect($this->getRequestedRolls())->map(function ($item) use ($rolls) {
            $roll = $rolls->where("id", $item["roll_id"])->first();
            if ($roll) {
                $item["capital"] = $roll->basic_price * $item["quantity_unit"];
                $item["type"] = "sold";
                $item["user_id"] = Auth::user()->id;
                $item["invoice_id"] = $this->getInvoice()->id;
                $item["profit"] = $item["sub_total"] - $item["capital"];
                $item["created_at"] = Carbon::now();
                $item["updated_at"] = Carbon::now();
                unset($item["sub_total"]);
                return $item;
            }
        });

        RollTransaction::insert($rollTransaction->toArray());
    }

    /** number
     *
     * @return string of generated invoice code
     */
    private function getGeneratedInvoiceCode(): string
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
    private function getTotalCapital(array $requestedRolls): int
    {
        $totalCapital = 0;
        $rolls = $this->getDataRolls();
        foreach ($requestedRolls as $roll) {
            $foundRoll = $rolls->where("id", $roll["roll_id"])->first();
            $totalCapital = $foundRoll->basic_price * $roll["quantity_unit"];
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
