<?php

namespace App\Services\DataMaster;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

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


    /**
     * Use to give data for create view
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Role",
            "description" => "Role of every user to differentiate their access right",
            "cardTitle"   => "Roles",
            "roles"       => $this->repository->getAllDataPaginated()
        ];
    }

    /**
     * Use to add new data role
     *
     * @param array $requestedData
     * @return array $response
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $response = [
                "success" => true,
                "role" => $this->repository->addNewData($requestedData)
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ? $e->getMessage() : 'Something went wrong'
            ];
        }
        return $response;
    }
}
