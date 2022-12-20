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

        $recencyPoint = $this->getRangePoint($maxR);
        $frequencyPoint = $this->getRangePoint($maxF);
        $moneteryPoint = $this->getRangePoint($maxM);

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

        $maxRFM = $customer->max("total_rfm");
        $rfmPoint = $this->getRangePoint($maxRFM, 4);
        $maping = ["bz", "m", "mgc", "mvc"];
        $customerDistribution = ["bz"  => [], "m"   => [], "mgc" => [], "mvc" => []];

        foreach ($customer as $key => $value) {
            foreach ($rfmPoint as $subKey => $subValue) {
                if ($value["total_rfm"] > $subValue["lower_threshold"] && $value["total_rfm"] <= $subValue["upper_threshold"]) {
                    array_push($customerDistribution[$maping[$subKey]], $value);
                }
            }
        }


        return $customerDistribution;
    }

    private function getRangePoint(int $maxValue, int $divider = 5): array
    {
        $rangePoint = [];

        for ($i = 1; $i <= 5; $i++) {
            array_push($rangePoint, ["lower_threshold" => $maxValue / $divider * ($i - 1), "upper_threshold" => $maxValue / $divider * $i]);
        }
        return $rangePoint;
    }

}

?>
