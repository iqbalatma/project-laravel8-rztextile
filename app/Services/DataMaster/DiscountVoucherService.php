<?php

namespace App\Services\DataMaster;

use App\Repositories\DiscountVoucherRepository;
use App\Repositories\RoleRepository;
use Iqbalatma\LaravelExtend\BaseService;

class DiscountVoucherService extends BaseService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new DiscountVoucherRepository();
    }
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "Discount Vouchers",
            "description" => "Discount voucher for customer when they purchase product",
            "cardTitle"   => "Discount Vouchers",
            "discountVouchers"       => $this->repository->getAllDataPaginated()
        ];
    }
}
