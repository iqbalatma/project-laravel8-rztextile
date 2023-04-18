<?php

namespace App\Repositories;

use App\AppData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function getAllDataPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE): ?object
    {
        return $this->model->select($columns)
            ->where("id", "!=", Auth::user()->id)
            ->paginate($perPage);
    }

    public function getDataUserByEmail(string $email, array $columns = ["*"])
    {
        return $this->model->where("email", $email)->first($columns);
    }


    public function updateDataUserByEmail(string $email, array $requestedData)
    {
        return $this->model->where("email", $email)->update($requestedData);
    }

    public function changeStatusById(int $id)
    {
        $user = $this->getDataById($id);
        $user->is_active ? $user->is_active = false : $user->is_active = true;
        $user->save();

        return $user;
    }
}
