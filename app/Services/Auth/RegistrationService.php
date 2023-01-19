<?php

namespace App\Services\Auth;

use App\Jobs\SendVerificationEmailJob;
use App\Repositories\UserRepository;
use App\Services\DataMaster\RegistrationCredentialService;
use Illuminate\Support\Facades\Hash;
use Iqbalatma\LaravelExtend\BaseService;

class RegistrationService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => "Registration",
        ];
    }


    /**
     * Description : use to add new data user
     *
     * @param array $requestedData from clinet
     */
    public function storeNewData(array $requestedData): bool|object
    {
        $role_id = (new RegistrationCredentialService())->checkIsCredentialValid($requestedData["registration_credential"]);

        if (!$role_id) {
            return false;
        }

        $requestedData["role_id"] = $role_id;
        $requestedData["password"] = Hash::make($requestedData["password"]);
        $user = $this->repository->addNewData($requestedData);

        dispatch(new SendVerificationEmailJob($user));

        return $user;
    }
}
