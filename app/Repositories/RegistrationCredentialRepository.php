<?php

namespace App\Repositories;

use App\AppData;
use App\Models\RegistrationCredential;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class RegistrationCredentialRepository extends BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new RegistrationCredential();
    }


    public function getDataByCredential(string $credential)
    {
        return RegistrationCredential::where([
            "credential" => $credential,
            "is_active" => true
        ])->first();
    }
}
