<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionMessages\PromotionMessageStoreRequest;
use App\Http\Requests\PromotionMessages\PromotionMessageUpdateRequest;
use App\Http\Requests\PromotionMessages\StorePromotionMessageRequest;
use App\Services\CRM\PromotionMessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PromotionMessageController extends Controller
{

    /**
     * Description : use to get index view
     *
     * @param PromotionMessageService $service dependency injection
     * @return Response
     */
    public function index(PromotionMessageService $service): Response
    {
        return response()->view("promotion-messages.index", $service->getAllData());
    }


    /**
     * Description : use to show create view
     *
     * @param PromotionMessageService $service
     * @return Response
     */
    public function create(PromotionMessageService $service): Response
    {
        return response()->view("promotion-messages.create", $service->getCreateData());
    }


    /**
     * Description : use to add new data to database table
     *
     * @param PromotionMessageService $service
     */
    public function store(PromotionMessageService $service, StorePromotionMessageRequest $request)
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("promotion.messages.index");

        $stored ?
            $redirect->with("success", "Add promotion message data roll successfully") :
            $redirect->with("failed", "Add promotion message data roll failed");

        return $redirect;
    }


    public function edit(PromotionMessageService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getEditData($id);

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }
        return response()->view("promotion-messages.edit", $response);
    }

    public function update(PromotionMessageService $service, PromotionMessageUpdateRequest $request): RedirectResponse
    {
        $response = $service->updateData($request->validated());

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }

        return redirect()
            ->route("promotion.messages.index")
            ->with("success", "Update data promotion message successfully");
    }

    public function destroy(PromotionMessageService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);

        if ($this->isError($response)) {
            return $this->getErrorResponse();
        }
        return redirect()
            ->route("promotion.messages.index")
            ->with("success", "Delete data promotion message successfully");
    }
}
