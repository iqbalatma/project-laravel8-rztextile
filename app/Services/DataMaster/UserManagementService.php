<?php

namespace App\Services\DataMaster;

use App\AppData;
use App\Jobs\SendVerificationEmailJob;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
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
            "users"       => $this->repository->getAllDataPaginated()
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
        try {
            $this->checkData($id);
            $response =  [
                "success" => true,
                "title"       => "User Management",
                "description" => "Form for edit data user",
                "cardTitle"   => "Edit User",
                "roles"       => $this->roleRepo->getAllData(),
                "user"        => $this->getData()
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }


    /**
     * Description : use to add new data user
     *
     * @param array $requestedDatata
     * @return object of new eloquent instance
     */
    public function storeNewData(array $requestedData): object
    {
        $requestedData["password"] = Hash::make($requestedData["password"]);
        $user = $this->repository->addNewData($requestedData);
        dispatch(new SendVerificationEmailJob($user));
        return $user;
    }


    /**
     * Description : use to update data user by user id
     *
     * @param int $id of user that want to be updated
     * @param array $requestedData request from client
     * @return array
     */
    public function updateData(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $data = $this->repository->updateDataById($id, $requestedData, isReturnObject: false);
            $response =  [
                "success" => true,
                "data" => $data
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }

    /**
     * Delete data user by id
     * @param int $id
     * @return array
     */
    public function changeStatusById(int $id): array
    {
        try {
            $this->checkData($id);
            $user = $this->repository->changeStatusById($id);
            $response = [
                "success" => true,
                "data" => $user
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }
}
