<?php

namespace App\Services\CRM;

use App\AppData;
use App\Repositories\PromotionMessageRepository;
use Iqbalatma\LaravelServiceRepo\BaseService;

class SegmentedCustomerService extends BaseService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new PromotionMessageRepository();
    }
    public function getAllData(): array
    {
        $data = [
            "title"        => "Segmented Customer",
            "description"  => "Data customer with rfm point",
            "segments" => AppData::CUSTOMER_SEGMENTS,
            "promotion_message_discount" => $this->repository->getFirstOfAllDifferentByCustomerSegmentedId(),
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
