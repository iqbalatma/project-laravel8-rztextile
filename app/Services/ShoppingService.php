<?php 
namespace App\Services;

use App\AppData;
use App\Repositories\RollRepository;

class ShoppingService{
  private const ALL_ROLL_SELECT_COLUMN = [
    AppData::TABLE_ROLL.".id",
    AppData::TABLE_ROLL.".name",
    AppData::TABLE_ROLL.".code",
    AppData::TABLE_ROLL.".quantity_roll",
    AppData::TABLE_ROLL.".quantity_unit",
    AppData::TABLE_ROLL.".basic_price",
    AppData::TABLE_ROLL.".selling_price",
    AppData::TABLE_ROLL.".unit_id",
    AppData::TABLE_ROLL.".qrcode",
  ];
  /**
   * Description : use to get all data for index controller
   * 
   * @return array
   */
  public function getAllData():array
  {
    return [
      "title" => "Shopping",
      "cardTitle" => "Shopping",
      "rolls" => (new RollRepository())->getAllDataRoll(self::ALL_ROLL_SELECT_COLUMN)
    ];
  }
}

?>