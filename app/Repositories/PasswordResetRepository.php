<?php 
namespace App\Repositories;

use App\Models\PasswordReset;

class PasswordResetRepository{
  public function addNewDataPasswordReset(array $requestedData):?object
  {
    return PasswordReset::create($requestedData);
  }

  public function deleteDataPasswordResetByEmail(string $email)
  {
    return PasswordReset::where("email", $email)->delete();
  }

  public function getDataPasswordResetByEmailToken(array $whereClause)
  {
    return PasswordReset::where($whereClause)->first();
  }
}
?>