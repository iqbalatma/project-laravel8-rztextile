<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfiles\UpdateUserProfileRequest;
use App\Services\DataMaster\UserProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    public function edit(UserProfileService $service): Response
    {
        $response = $service->getEditData();
        viewShare($response);
        return response()->view("user-profiles.edit");
    }

    public function update(UserProfileService $service, UpdateUserProfileRequest $request): RedirectResponse
    {
        $response = $service->updateDataById($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with("success", "Update your profile successfully");
    }
}
