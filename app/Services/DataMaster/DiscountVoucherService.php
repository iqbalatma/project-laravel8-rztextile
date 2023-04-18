<?php

namespace App\Services\DataMaster;

use App\Repositories\DiscountVoucherRepository;
use App\Repositories\RoleRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

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


    /**
     * Use to get show form add
     *
     * @return array
     */
    public function getCreateData(): array
    {
        return [
            "title"       => "Add Discount Vouchers",
            "description" => "Discount voucher for customer when they purchase product",
            "cardTitle"   => "Discount Vouchers",
        ];
    }


    /**
     * Use to add new data
     *
     * @param array $requestedData
     * @return array
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $this->repository->addNewData($requestedData);

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


    /**
     * Use to update status id
     *
     * @param integer $id
     * @param string $status
     * @return array
     */
    public function updateStatusById(int $id, string $status): array
    {
        try {
            $this->checkData($id);
            $discountVoucher = $this->getData();

            if ($status == "validate") {
                $discountVoucher->is_valid = true;
            } else {
                $discountVoucher->is_valid = false;
            }

            $discountVoucher->save();

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
