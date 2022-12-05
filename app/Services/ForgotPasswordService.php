<?php

namespace App\Services;

use App\Mail\ResetPasswordMail;
use App\Mail\ResetPasswordRequest;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordService
{

  /**
   * Description : use to get all data for forgot view
   * 
   * @return array
   */
  public function getForgotData():array
  {
    return [
      "title" => "Forgot Password"
    ];
  }

    /**
   * Description : use to get all data for reset view
   * 
   * @return array
   */
  public function getResetData(string $token):array
  {
    return [
      "title" => "Reset Password",
      "token" => $token
    ];
  }


  /**
   * Description : use to reset password
   * 
   * @param array $requestedData email from reset password
   */
  public function resetPassword(array $requestedData)
  {
    $resetData = [
      "email" => $requestedData["email"],
      "token" => Str::random(40),
      "created_at" => Carbon::now()
    ];

    $passwordRepository = new PasswordResetRepository();
    try{
      DB::beginTransaction();
      $user = (new UserRepository())->getDataUserByEmail($requestedData["email"]);
      if(!$user){
        return false;
      }
      $passwordRepository->deleteDataPasswordResetByEmail($requestedData["email"]);
      $reset = $passwordRepository->addNewDataPasswordReset($resetData);
      Mail::to($reset->email)->send(new ResetPasswordMail($reset->token));
      DB::commit();
    }catch(Exception $e){
      DB::rollback();
      return false;
    }

    return true;
  }


}
