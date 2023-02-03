<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suggestions\StoreSuggestionRequest;
use App\Services\CRM\SuggestionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SuggestionController extends Controller
{
    public function index(SuggestionService $service):Response
    {
        return response()->view("suggestions.index", $service->getAllData());
    }
    public function store(SuggestionService $service,StoreSuggestionRequest $request)
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response))
            return $this->getErrorResponse();

        return redirect()->back()->with("success", "Your message has been sent !");
    }
}
