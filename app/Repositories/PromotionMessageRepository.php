<?php

namespace App\Repositories;

use App\AppData;
use App\Models\PromotionMessage;
use Iqbalatma\LaravelExtend\BaseRepository;

class PromotionMessageRepository extends BaseRepository
{

    protected $model;
    public function __construct()
    {
        $this->model = new PromotionMessage();
    }

    public function getDataByCustomerSegmentationId(int $id, array $columns = ["*"])
    {
        return $this->model->select($columns)->where("customer_segmentation_id", $id)->get();
    }
}
