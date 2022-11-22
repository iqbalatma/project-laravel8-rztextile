<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Description : use to show form login
     * 
     * @param AuthService $service dependency injection
     * @return Response
     */
    public function login(AuthService $service):Response
    {
        return response()->view("auth.login", $service->getLoginData());
    }


    /**
     * Description : use to check is user authenticate or not
     * 
     * @param AuthService $service dependency injection
     * @param AuthenticateRequest $request dependency injection
     */
    public function authenticate(AuthService $service, AuthenticateRequest $request):RedirectResponse
    {
        if(Auth::attempt($request->validated())){
            return redirect()->intended(route("dashboard.index"));
        }

        return redirect()->back()->with("failed", "Username or password is invalid");
    }


    /**
     * Description : use to logout account
     * 
     * @param Request $request
     */
    public function logout(Request $request):RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


}
