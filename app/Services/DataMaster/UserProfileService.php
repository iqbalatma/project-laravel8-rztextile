<?php

namespace App\Services\DataMaster;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class UserProfileService extends BaseService
{

    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * Use to show view edit profile
     *
     * @return array
     */
    public function getEditData(): array
    {
        return [
            "title" => "My Profile",
            "cardTitle" => "Update Profile",
            "user" => Auth::user()
        ];
    }


    /**
     * Use to update data profile
     *
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(array $requestedData): array
    {
        try {
            $this->checkData(Auth::id());
            $user = $this->getData();
            $user->fill($requestedData);
            $user->save();

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ?  $e->getMessage() : 'Something went wrong'
            ];
        }

        return $response;
    }
}
