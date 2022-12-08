<?php 
namespace App\Services;

use App\Repositories\RollRepository;

class AjaxSearchRollService{

  public function getShowData(int $id)
  {
    return (new RollRepository())->getDataRollById($id);
  }




}

?>