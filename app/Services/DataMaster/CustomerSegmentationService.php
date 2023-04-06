<?php


namespace App\Services\DataMaster;

use App\Repositories\CustomerSegmentationRepository;
use Iqbalatma\LaravelServiceRepo\BaseService;

class CustomerSegmentationService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new CustomerSegmentationRepository();
    }

    /**
     * To get all data for index view
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => "Customer Segmentation",
            "cardTitle" => "Customer Segmentation",
            "description" => "All segmentation for customers",
            "customerSegmentations" => $this->repository->getAllData()
        ];
    }
}
