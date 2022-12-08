<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    protected $redirectTo = "/";
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('auth.verification', [
                            'title' => __('Account Verification'),
                            'cardTitle' => __('Account Verification'),
                            'pageTitle' => __('Account Verification')
                        ]);

    }


    /**
     * Description : use to resend email verification
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function resend(Request $request):RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }
}
