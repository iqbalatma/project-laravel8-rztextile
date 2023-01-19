<?php

namespace App\Services\AJAX;

use App\Repositories\DiscountVoucherRepository;
use Iqbalatma\LaravelExtend\BaseService;

class AjaxDiscountVoucherService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new DiscountVoucherRepository();
    }
    public function checkVoucherCode(string $code)
    {
        return $this->repository->getValidDataByCode($code);
    }
}
