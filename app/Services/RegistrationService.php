<?php 
namespace App\Services;

use App\Mail\OrderShipped;
use App\Notifications\WelcomeEmailNotification;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegistrationService{

  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Registration",
    ];
  }


  /**
   * Description : use to add new data user
   * 
   * @param array $requestedData from clinet
   * @return ?object
   */
  public function storeNewData(array $requestedData)
  {
    // $role_id = (new RegistrationCredentialService())->checkIsCredentialValid($requestedData["registration_credential"]);

    // if(!$role_id){
    //   return false;
    // }

    // $requestedData["role_id"] = $role_id;
    $requestedData["role_id"] = 1;
    $requestedData["password"] = Hash::make($requestedData["password"]);
    $user = (new UserRepository())->addNewDataUser($requestedData);

    $user->notify(new WelcomeEmailNotification());
    Mail::to($user)->send(new OrderShipped());
    event(new Registered($user));
    auth()->login($user);

    return $user;
  }


}

?>