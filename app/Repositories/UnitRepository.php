<?php

namespace App\Repositories;

use App\Models\Unit;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class UnitRepository extends BaseRepository
{
    protected  $model;

    public function __construct()
    {
        $this->model = new Unit();
    }
}
