<?php

namespace App\Repositories;

use App\AppData;
use App\Models\Unit;
use Iqbalatma\LaravelExtend\BaseRepository;

class UnitRepository extends BaseRepository
{
    protected  $model;

    public function __construct()
    {
        $this->model = new Unit();
    }
}
