<?php

namespace App\Services\AJAX;

use App\Contracts\Abstracts\BaseShoppingService;
use Exception;
use Illuminate\Support\Facades\DB;

class AjaxShoppingService extends BaseShoppingService
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Use to purchase rolls
     *
     * @param array $requestedData
     * @return array
     */
    public function purchase(array $requestedData): array
    {
        // use to separated data roll from request
        $this->setRequestedRolls($requestedData["rolls"]);

        // use to set data rolls from db, to get something like original price or hpp
        $this->setDataRolls($this->rollRepo->getDataRollByIds(
            array_column($this->getRequestedRolls(), 'roll_id')
        ));

        ddapi($this->getDataRolls());

        try {
            DB::beginTransaction();

            $this->addNewInvoice($requestedData);

            if ($requestedData["paid_amount"] > 0) {
                #to add data payment
                $this->addNewPayment($requestedData);
            }

            #to add roll transaction hisotry
            $this->addNewRollTransaction();

            #to reduce data roll that sold out
            $this->reduceQuantityRollAndUnit();

            DB::commit();
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $response = [
                "success" => false,
                "message" => config('app.env') != 'production' ?  $e->getMessage() : 'Something went wrong'
            ];
        }

        return $response;
    }
}
