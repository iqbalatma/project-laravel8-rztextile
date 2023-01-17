<?php

namespace App\Services\DataMaster;

use App\Repositories\RoleRepository;
use Iqbalatma\LaravelExtend\BaseService;

class RoleService extends BaseService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new RoleRepository();
    }
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "Role",
            "description" => "Role of every user to differentiate their access right",
            "cardTitle"   => "Roles",
            "roles"       => $this->repository->getAllDataPaginated()
        ];
    }
}
