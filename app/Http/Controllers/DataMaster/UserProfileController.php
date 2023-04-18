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
    /**
     * Use to show form edit user profile
     *
     * @param UserProfileService $service
     * @return Response
     */
    public function edit(UserProfileService $service): Response
    {
        $response = $service->getEditData();
        viewShare($response);
        return response()->view("user-profiles.edit");
    }


    /**
     * Use to update data user profile
     *
     * @param UserProfileService $service
     * @param UpdateUserProfileRequest $request
     * @return RedirectResponse
     */
    public function update(UserProfileService $service, UpdateUserProfileRequest $request): RedirectResponse
    {
        $response = $service->updateDataById($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with("success", "Update your profile successfully");
    }
}
