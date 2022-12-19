<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RFMService
{





    /**
     * Summary of getRFM
     * NOTES : this can be improved by add summary transaction invoice and amount of bill every new transaction
     * so you can create column for summary
     * total_invoice
     * total_bill_amount
     * and then you can get their latest transaction
     * @return
     */
    public function getRFM()
    {
        $now = Carbon::now();
        $customer = collect((new InvoiceRepository())->getDataInvoiceForRFM())->map(function ($item) use ($now) {
            $item["recency"] = Carbon::parse($item["latest_invoice_date"])->diffInDays($now);
            return $item;
        });


        $maxR = $customer->max("recency");
        $maxF = $customer->max("total_invoices");
        $maxM = $customer->max("total_bill");

        $recencyPoint = $this->getRFMPoint($maxR);
        $frequencyPoint = $this->getRFMPoint($maxF);
        $moneteryPoint = $this->getRFMPoint($maxM);

        $customer = $customer->map(function ($item) use ($recencyPoint, $frequencyPoint, $moneteryPoint) {
            $item["total_rfm"] = 0;
            foreach ($recencyPoint as $key => $value) {
                if ($item["recency"] > $value["lower_threshold"] && $item["recency"] <= $value["upper_threshold"]) {
                    $item["total_rfm"] += $key + 1;
                }
            }
            foreach ($frequencyPoint as $key => $value) {
                if ($item["recency"] > $value["lower_threshold"] && $item["recency"] <= $value["upper_threshold"]) {
                    $item["total_rfm"] += $key + 1;
                }
            }
            foreach ($moneteryPoint as $key => $value) {
                if ($item["recency"] > $value["lower_threshold"] && $item["recency"] <= $value["upper_threshold"]) {
                    $item["total_rfm"] += $key + 1;
                }
            }
            return $item;
        });

        return $customer;
    }

    private function getRFMPoint($maxRFM): array
    {
        $rfmPoint = [];

        for ($i = 1; $i <= 5; $i++) {
            array_push($rfmPoint, ["lower_threshold" => $maxRFM / 5 * ($i - 1), "upper_threshold" => $maxRFM / 5 * $i]);
        }
        return $rfmPoint;
    }

}

?>
