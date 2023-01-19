<?php

namespace App\Services\CRM;

use App\AppData;
use Iqbalatma\LaravelExtend\BaseService;

class SegmentedCustomerService extends BaseService
{
    public function getAllData(): array
    {
        $data = [
            "title"        => "Segmented Customer",
            "description"  => "Data customer with rfm point",
            "segments" => AppData::CUSTOMER_SEGMENTS,
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
