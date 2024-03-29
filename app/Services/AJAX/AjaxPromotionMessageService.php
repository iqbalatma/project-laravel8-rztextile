<?php

namespace App\Services\AJAX;

use App\Repositories\PromotionMessageRepository;

class AjaxPromotionMessageService
{
    /**
     * Description : use to get data by id
     *
     * @param int $id
     * @return ?object eloquent model
     */
    public function getShowData(int $id): ?object
    {
        return (new PromotionMessageRepository())->getDataById($id);
    }
    public function getDataByCustomerSegmentationId(int $id): ?object
    {
        return (new PromotionMessageRepository())->getDataByCustomerSegmentationId($id);
    }
}
