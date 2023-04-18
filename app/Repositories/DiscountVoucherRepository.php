<?php

namespace App\Repositories;

use App\Models\DiscountVoucher;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class DiscountVoucherRepository extends BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new DiscountVoucher();
    }

    public function getValidDataByCode(string $code, array $columns = ["*"]): ?object
    {
        return $this->model
            ->with("promotion_message")
            ->select($columns)->where([
                "code"     => $code,
                "is_valid" => true
            ])->first();
    }
}
