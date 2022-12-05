<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendResetLinkRequest;
use App\Services\ForgotPasswordService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot(ForgotPasswordService $service):Response
    {
        return response()->view("auth.forgot-password", $service->getForgotData());
    }

    public function reset(ForgotPasswordService $service, string $token)
    {
        return response()->view("auth.reset-password", $service->getResetData($token));
    }

    public function sendResetLink(ForgotPasswordService $service, SendResetLinkRequest $request)
    {
        $status = $service->resetPassword($request->validated());

        if($status){
            return redirect()->route("forgot.password.forgot")->with("success", "mantap");
        }else{
            return redirect()->route("forgot.password.forgot")->with("failed", "gagal");
        }
    }
}
