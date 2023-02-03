<?php

namespace App\Services\CRM;

use App\Repositories\SuggestionRepository;
use Iqbalatma\LaravelExtend\BaseService;

class SuggestionService extends BaseService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new SuggestionRepository();
    }


    public function addNewData()
    {
        # code...
    }

}
