<?php

namespace App\Services;

class SegmentedCustomerService
{

    public function getAllData(): array
    {
        $data = [
            "title"        => "Segmented Customer",
            "cardTitleMVC" => "Most valueable customer",
            "cardTitleMGC" => "Most growable customer",
            "cardTitleM"   => "Migration customer",
            "cardTitleBZ"  => "Below zero customer",
            "description"  => "Data customer with rfm point",
            "customers"      => [],
            "recencyPoint"   => [],
            "frequencyPoint" => [],
            "moneteryPoint"  => [],
            "rfmPoint"       => [],
        ];
        $customer = (new RFMService())->getRFM();
        return array_merge($data, $customer);
    }
}
