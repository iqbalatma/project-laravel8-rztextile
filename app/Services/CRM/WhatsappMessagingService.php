<?php

namespace App\Services\CRM;

use App\AppData;
use App\Http\Traits\WablasTrait;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerSegmentationRepository;
use App\Repositories\DiscountVoucherRepository;
use App\Repositories\PromotionMessageRepository;
use Illuminate\Support\Str;
use Iqbalatma\LaravelExtend\BaseService;

class WhatsappMessagingService extends BaseService
{

    protected $repository;
    private $custRepo;

    public function __construct()
    {
        $this->repository = new PromotionMessageRepository();
        $this->custRepo = new CustomerRepository();
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
        $payloads = $this->getDataPayload($requestedData);
        return WablasTrait::sendMessage($payloads);
    }

    public function sendBlast(array $requestedData)
    {
        $dataRFM = (new RFMService())->getRFM();
        $customerSegmentation = (new CustomerSegmentationRepository())->getDataById($requestedData["segmentation_id"]);
        $promotionMessage = (new PromotionMessageRepository())->getDataById($requestedData["promotion_message_id"]);
        if (isset($dataRFM["customers"][$customerSegmentation->key])) {
            $dataSet = collect($dataRFM["customers"][$customerSegmentation->key])->map(function ($item) use ($requestedData, $customerSegmentation, $promotionMessage) {
                $code = strtoupper(Str::random(8));
                (new DiscountVoucherRepository())->addNewData([
                    "code" => $code,
                    "promotion_message_id" => $promotionMessage->id
                ]);
                $voucher = "<p>&nbsp;</p><p>Masukkan voucher <strong>$code</strong> untuk mendapatkan discount $promotionMessage->discount %</p>";
                return [
                    "phone"   => $item["customer"]["phone"],
                    "message" => $promotionMessage->message . $voucher
                ];
            });

            return WablasTrait::sendBlast(["data" => $dataSet]);
        }
    }

    private function getDataPayload(array $requestedData): array
    {
        $customers = $this->custRepo->getCustomerByIds($requestedData["customer"], self::GET_CUSTOMER_BY_IDS_COLUMN);

        $message = preg_replace('/<strong>|<\/strong>/', '*', $requestedData["message"]);
        $message = preg_replace('/&nbsp;/', '', $message);
        $message = preg_replace('/<em>|<\/em>/', '_', $message);
        $message = preg_replace('/<p>|<\/p>/', '', $message);
        $payload = collect($customers)->map(function ($item) use ($message) {
            return [
                "phone"   => preg_replace('/[^0-9]/', '', $item->phone),
                "message" => $message
            ];
        })->toArray();
        return ["data" => $payload];
    }
}
