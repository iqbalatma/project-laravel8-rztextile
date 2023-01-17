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
}
