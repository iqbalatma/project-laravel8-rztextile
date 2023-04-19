<?php

namespace App\Services\Transactions;

use App\AppData;
use App\Contracts\Abstracts\BaseShoppingService;
use App\Models\RollTransaction;
use App\Repositories\CustomerRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\RollRepository;
use App\Services\Transactions\PaymentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseService;

class ShoppingService extends BaseShoppingService
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Description : use to get all data for index controller
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title"       => "Shopping",
            "description" => "For transaction with customer and purchasing",
            "cardTitle"   => "Shopping",
            "rolls"       => $this->rollRepo->getAllDataRoll(self::ALL_ROLL_SELECT_COLUMN),
            "customers"   => $this->custRepo->getAllData(self::ALL_CUSTOMER_SELECT_COLUMN)
        ];
    }
}
