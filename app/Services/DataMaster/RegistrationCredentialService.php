<?php

namespace App\Services\DataMaster;

use App\Repositories\RegistrationCredentialRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\Str;
use Iqbalatma\LaravelServiceRepo\BaseService;

class RegistrationCredentialService extends BaseService
{
    protected $repository;
    private $roleRepo;
    public function __construct()
    {
        $this->repository = new RegistrationCredentialRepository();
        $this->roleRepo = new RoleRepository();
    }
    /**
     * Descriptioon : use to get all data for view index
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"                   => "Registration Credentials",
            "description"             => "Registration credential for register from outside of admin system",
            "cardTitle"               => "Registration Credentials",
            "registrationCredentials" => $this->repository->getAllDataPaginated()
        ];
    }


    public function getCreateData(): array
    {
        return [
            "title"       => "Registration Credentials",
            "description" => "Form for add new registration credential",
            "cardTitle"   => "Registration Credentials",
            "roles"       => $this->roleRepo->getAllData(),
            "credential"  => Str::random(16)
        ];
    }

    public function storeNewData(array $requestedData)
    {
        return $this->repository->addNewData($requestedData);
    }

    public function destroyData(int $id)
    {
        return $this->repository->deleteDataById($id);
    }

    public function updateData(int $id, array $requestedData): bool
    {
        return $this->repository->updateDataById($id, $requestedData);
    }

    public function checkIsCredentialValid(string $credential): ?int
    {
        $credential = $this->repository->getDataByCredential($credential);

        if ($credential) {
            return $credential->role_id;
        }

        return null;
    }
}
