<?php

namespace App\Services\AJAX;

use App\Repositories\RollRepository;
use Iqbalatma\LaravelServiceRepo\BaseService;

class AjaxSearchRollService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RollRepository();
    }
    /**
     * Description : use to get data roll by id
     *
     * @param int $id
     * @return ?object
     */
    public function getShowData(int $id): ?object
    {
        return $this->repository->with(["unit"])->getDataById($id);
    }
}
