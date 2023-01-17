<?php

namespace App\Repositories;

use App\Models\Role;
use Iqbalatma\LaravelExtend\BaseRepository;

class RoleRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Role();
    }
}
