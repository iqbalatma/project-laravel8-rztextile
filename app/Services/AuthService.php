<?php

namespace App\Services;

use App\Repositories\RollTransactionRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{

  /**
   * Description : use to get all data for login auth controller
   * 
   * @return array
   */
  public function getLoginData(): array
  {
    return [
      "title" => "Login",
    ];
  }



  public function authenticate(array $requestedData): bool
  {
    $rememberme = false;
    if(isset($requestedData["rememberme"])){
      $rememberme = $requestedData["rememberme"];

      unset($requestedData["rememberme"]);
    }

    if (Auth::attempt($requestedData, $rememberme)) {
      return true;
    }
    return false;
  }


  /**
   * Description : use to invalidate session
   * 
   * @param object $requestedData
   * @return void
   */
  public function logout(object $requestedData): void
  {
    Auth::logout();

    $requestedData->session()->invalidate();
    $requestedData->session()->regenerateToken();
  }
}
