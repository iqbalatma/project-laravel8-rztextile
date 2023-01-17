<?php

namespace App\Services\CRM;

use App\Repositories\CustomerSegmentationRepository;
use App\Repositories\PromotionMessageRepository;
use Exception;
use Iqbalatma\LaravelExtend\BaseService;

class PromotionMessageService extends BaseService
{
    protected $repository;
    private $cusSegRepo;
    public function __construct()
    {
        $this->repository = new PromotionMessageRepository();
        $this->cusSegRepo = new CustomerSegmentationRepository();
    }
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
            "promotionMessages" => $this->repository->getAllDataPaginated()
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
            "customerSegmentations" => $this->cusSegRepo->getAllData()
        ];
    }


    /**
     * Use to add new data
     * @param array $requestedData
     * @return object
     */
    public function storeNewData(array $requestedData): object
    {
        return $this->repository->addNewData($requestedData);
    }

    /**
     * Use to get edit data
     * @param int $id
     * @return array
     */
    public function getEditData(int $id): array
    {
        try {
            $this->checkData($id);

            $response = [
                "success" => true,
                "title"       => "Promotion Messages",
                "description" => "Edit promotion message template",
                "cardTitle"   => "Promotion Messages",
                "message" => $this->getData()
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }

        return $response;
    }

    /**
     * Use to update data promotion message
     * @param array $requestedData
     * @return array
     */
    public function updateData(array $requestedData): array
    {
        try {
            $this->checkData($requestedData["id"]);
            $data = $this->repository->updateDataById($requestedData["id"], $requestedData);
            $response = [
                "success" => true,
                "data" => $data
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }

    /**
     * Use to delete data by id
     * @param int $id
     * @return array
     */
    public function deleteDataById(int $id)
    {
        try {
            $this->checkData($id);
            $data = $this->repository->deleteDataById($id);
            $response = [
                "success" => true,
                "data" => $data
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }
}
