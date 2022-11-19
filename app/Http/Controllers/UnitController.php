<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class UnitController extends Controller
{
    /**
     * Description : use to show all data unit
     * 
     * @return Response for html view
     */
    public function index():Response
    {
        return response()->view("units.index");
    }
}
