<?php

namespace App\Repositories;

use App\Models\DiscountVoucher;
use Iqbalatma\LaravelExtend\BaseRepository;

class DiscountVoucherRepository extends BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new DiscountVoucher();
    }
}
