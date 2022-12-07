<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationCredentials\RegistrationCredentialStoreRequest;
use App\Services\RegistrationCredentialService;
use Illuminate\Http\Response;

class RegistrationCredentialController extends Controller
{
    /**
     * Desription : use to show index view
     * 
     * @param RegistrationCredentialService $servcice dependency injection
     * @return Response
     */
    public function index(RegistrationCredentialService $service):Response
    {
        return response()->view("registration-credentials.index", $service->getAllData());
    }

    public function create(RegistrationCredentialService $servcice)
    {
        return response()->view("registration-credentials.create", $servcice->getCreateData());
    }

    public function store(RegistrationCredentialService $service, RegistrationCredentialStoreRequest $request)
    {
        $stored = $service->storeNewData($request->validated());

        $redirect = redirect()
            ->route("registration.credentials.create");
            
        $stored?
            $redirect->with("success", "Add new registration credential successfully"):
            $redirect->with("failed", "Add new registration credential failed");

        return $redirect;
    }
}
