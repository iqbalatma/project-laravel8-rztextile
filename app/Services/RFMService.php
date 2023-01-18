<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Carbon\Carbon;
use Iqbalatma\RFMCalculation\RFMCalculation;

class RFMService
{
    private $dataCustomer;
    private $dataRFM = [];
    public function __construct()
    {
        $this->dataCustomer = (new InvoiceRepository())->getDataInvoiceForRFM();
        if ($this->dataCustomer->count()) {
            $this->dataCustomer = collect($this->dataCustomer)->map(function ($item) {
                $item["recency"] = Carbon::parse($item["latest_invoice_date"])->diffInDays("2019-12-31 00.00.00");
                return $item;
            });
            $rfmCalculation = new RFMCalculation($this->dataCustomer);
            $this->dataRFM = $rfmCalculation->getRFM();
        };
    }

    public function getRFM()
    {
        return $this->dataRFM;
    }
}
