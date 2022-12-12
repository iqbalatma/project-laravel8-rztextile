<?php

namespace App\Http\Controllers;

use App\Services\PromotionMessageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PromotionMessageController extends Controller
{

    /**
     * Description : use to get index view
     * 
     * @param PromotionMessageService $service dependency injection
     * @return Response
     */
    public function index(PromotionMessageService $service):Response
    {
        return response()->view("promotion-messages.index", $service->getAllData());
    }


    /**
     * Description : use to show create view
     * 
     * @param PromotionMessageService $service
     * @return Response
     */
    public function create(PromotionMessageService $service):Response
    {
        return response()->view("promotion-messages.create",$service->getCreateData());
    }
}
