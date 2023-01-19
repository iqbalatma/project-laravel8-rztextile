<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Services\Stock\SearchRollService;
use Illuminate\Http\Response;

class SearchRollController extends Controller
{
    /**
     * Description : use to show search form
     *
     * @param SearchRollService $service dependency injection
     * @return Response
     */
    public function __invoke(SearchRollService $service): Response
    {
        return response()->view("search-roll.index", $service->getAllData());
    }
}
