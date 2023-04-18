<?php

namespace App\Services\CRM;

use App\AppData;
use App\Http\Traits\WablasTrait;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerSegmentationRepository;
use App\Repositories\DiscountVoucherRepository;
use App\Repositories\PromotionMessageRepository;
use App\Services\Utils\TinyMCEToWhatsappService;
use Illuminate\Support\Str;
use Iqbalatma\LaravelServiceRepo\BaseService;

class WhatsappMessagingService extends BaseService
{
    protected $repository;
    private $custRepo;
    private $discRepo;
    private $custSegRepo;

    public function __construct()
    {
        $this->repository = new PromotionMessageRepository();
        $this->custRepo = new CustomerRepository();
        $this->discRepo = new DiscountVoucherRepository();
        $this->custSegRepo = new CustomerSegmentationRepository();
    }

    private const GET_ALL_PROMOTION_MESSAGE_COLUMN = [
        AppData::TABLE_PROMOTION_MESSAGE . ".id",
        AppData::TABLE_PROMOTION_MESSAGE . ".name",
        AppData::TABLE_PROMOTION_MESSAGE . ".message",
    ];

    private const GET_CUSTOMER_BY_IDS_COLUMN = [
        AppData::TABLE_USER . ".phone",
    ];

    public function getAllData(): array
    {
        return [
            "title"             => "Whatsapp Messaging",
            "description"       => "Send promotion broadcast message to customer",
            "cardTitle"         => "Whatsapp Messaging",
            "customers"         => $this->custRepo->getAllData(),
            "promotionMessages" => $this->repository->getAllData(self::GET_ALL_PROMOTION_MESSAGE_COLUMN),
            "dataRFM" => (new RFMService())->getRFM()
        ];
    }

    public function sendMessage(array $requestedData)
    {
        $promotionMessage = $this->repository->getDataById($requestedData["promotion_message_id"]);

        if (isset($requestedData["type"]) && $requestedData["type"] == "blast") {
            // the data came from RFM Service
            $dataRFM = (new RFMService())->getRFM();
            $customerSegmentation = $this->custSegRepo->getDataById($requestedData["segmentation_id"]);

            if (isset($dataRFM["customers"][$customerSegmentation->key])) {
                $customers = $dataRFM["customers"][$customerSegmentation->key];
                $payload = $this->generatePayload($requestedData, $customers, $promotionMessage);
            }
        } else {
            // The data came from customer repo
            $customers = $this->custRepo->getDataById($requestedData["customer"], self::GET_CUSTOMER_BY_IDS_COLUMN);
            $payload = $this->generatePayload($requestedData, $customers, $promotionMessage);
        }
        return WablasTrait::sendBlast(["data" => $payload]);
    }

    public function generatePayload(array $requestedData, object|array $customers, object $promotionMessage): array
    {
        $message = TinyMCEToWhatsappService::translate($promotionMessage->message);
        if($requestedData["type_gift"]=="prize"){
            $message = TinyMCEToWhatsappService::translate($promotionMessage->message_prize);
        }
        return collect($customers)->map(function ($item) use ($requestedData, $message, $promotionMessage) {
            $code = strtoupper(Str::random(8));
            $this->discRepo->addNewData(["code" => $code, "promotion_message_id" => $promotionMessage->id]);
            $phone = (isset($requestedData["type"]) && $requestedData["type"] == "blast") ? $item->customer->phone : $item->phone;

            if($requestedData["type_gift"]!="prize"){
                $message = $message . "\nMasukkan voucher *$code* untuk mendapatkan discount $promotionMessage->discount %</p>";
            }

            return [
                "phone"   => preg_replace('/[^0-9]/', '', $phone),
                "message" => $message
            ];
        })->toArray();
    }
}
