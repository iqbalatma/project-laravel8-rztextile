<?php

namespace App\Repositories;

use App\AppData;
use App\Models\PromotionMessage;
use Illuminate\Support\Facades\DB;
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
        return $this->model->select($columns)->where("customer_segmentation_id", $id)->first();
    }

    public function getFirstOfAllDifferentByCustomerSegmentedId()
    {
        return $this->model->select("promotion_messages.id", "promotion_messages.customer_segmentation_id", "promotion_messages.discount", "promotion_messages.prize")
            ->join(DB::raw("(SELECT customer_segmentation_id, MIN(id) as min_id from promotion_messages GROUP BY customer_segmentation_id) j"), function ($join) {
                $join->on("promotion_messages.customer_segmentation_id", "j.customer_segmentation_id")->on("promotion_messages.id", "j.min_id");
            })
            ->orderBy("promotion_messages.customer_segmentation_id")
            ->get();

        // return $this->model->select($columns)->distinct()->get();
    }
}
