<?php

namespace App\Services\Stock;

use App\Repositories\RollRepository;
use Iqbalatma\LaravelExtend\BaseService;

class SearchRollService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RollRepository();
    }


    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData()
    {
        return [
            "title"       => "Search Roll",
            "description" => "Form search roll",
            "cardTitle"   => "Search Roll",
            "rolls"       => $this->repository->getAllDataRoll()
        ];
    }
}
