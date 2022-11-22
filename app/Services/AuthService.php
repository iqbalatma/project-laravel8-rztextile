<?php

namespace App\Services;

use App\Repositories\RollTransactionRepository;

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
}
