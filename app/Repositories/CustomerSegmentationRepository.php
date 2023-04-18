<?php

namespace App\Repositories;

use App\Models\CustomerSegmentation;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class CustomerSegmentationRepository extends BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new CustomerSegmentation();
    }
}
