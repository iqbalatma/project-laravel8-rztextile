<?php

namespace App\Services;

use App\Repositories\PromotionMessageRepository;

class PromotionMessageService
{

    /**
     * Description : use to get all data for index view
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"             => "Promotion Messages",
            "description"       => "Data template promotion message",
            "cardTitle"         => "Promotion Messages",
            "promotionMessages" => (new PromotionMessageRepository())->getAllDataPaginated()
        ];
    }


    /**
     * Description : use to get data for create view
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Promotion Messages",
            "description" => "Add new promotion message template",
            "cardTitle"   => "Promotion Messages",
        ];
    }


    /**
     * Description : use to add new data
     *
     * @param array $requestedData
     */
    public function storeNewData(array $requestedData): ?object
    {
        return (new PromotionMessageRepository())->addNewData($requestedData);
    }

    public function getEditData(int $id)
    {
        return [
            "title"       => "Promotion Messages",
            "description" => "Edit promotion message template",
            "cardTitle"   => "Promotion Messages",
            "message" => (new PromotionMessageRepository())->getDataById($id)
        ];
    }

    public function updateData(array $requestedData)
    {
        return (new PromotionMessageRepository())->updateDataById($requestedData["id"], $requestedData);
    }

    public function deleteDataById(int $id)
    {
        return (new PromotionMessageRepository())->deleteDataById($id);
    }
}
