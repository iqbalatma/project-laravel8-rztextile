<?php

namespace App\Services;

use App\AppData;
use App\Jobs\SendVerificationEmailJob;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Iqbalatma\LaravelExtend\BaseService;

class UserManagementService extends BaseService
{

    protected $repository;
    private $roleRepo;
    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->roleRepo = new RoleRepository();
    }
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "User Management",
            "description" => "Data user of this application",
            "cardTitle"   => "User Management",
            "users"       => $this->repository->getAllDataUserPaginated()
        ];
    }


    /**
     * Description : use to get data for create new user form
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "User Management",
            "description" => "Form for add new data user",
            "cardTitle"   => "Add New User",
            "roles"       => $this->roleRepo->getAllData()->except([AppData::ROLE_ID_CUSTOMER])
        ];
    }


    /**
     * Description : use to get data for create new user form
     *
     * @param int $id of user that want to be edited
     * @return array
     */
    public function getEditData(int $id): array
    {
        return [
            "title"       => "User Management",
            "description" => "Form for edit data user",
            "cardTitle"   => "Edit User",
            "roles"       => $this->roleRepo->getAllData(),
            "user"        => $this->repository->getDataUserById($id)
        ];
    }


    /**
     * Description : use to add new data user
     *
     * @param array $requestedDatata
     * @return ?object of new eloquent instance
     */
    public function storeNewData(array $requestedData)
    {
        $requestedData["password"] = Hash::make($requestedData["password"]);
        $user = $this->repository->addNewDataUser($requestedData);
        dispatch(new SendVerificationEmailJob($user));
        return $user;
    }


    /**
     * Description : use to update data user by user id
     *
     * @param int $id of user that want to be updated
     * @param array $requestedData request from client
     * @return bool status of update data success or fail
     */
    public function updateData(int $id, array $requestedData): bool
    {
        return $this->repository->updateDataUserById($id, $requestedData);
    }

    /**
     * Delete data user by id
     * @param int $id
     * @return bool
     */
    public function changeStatusById(int $id)
    {
        return $this->repository->changeStatusById($id);
    }
}
