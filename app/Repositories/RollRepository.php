<?php 
namespace App\Repositories;

use App\AppData;
use App\Models\Roll;
use Illuminate\Support\Facades\DB;

class RollRepository{

  public function getAllDataRollPaginated(array $columns = ["*"], int $perPage = AppData::DEFAULT_PERPAGE):?object
  {
    return Roll::select($columns)
      ->paginate($perPage);
  }

  public function getAllDataRoll(array $columns = ["*"])
  {
    return Roll::with(["unit"=>function ($query){
      $query->select(["id","name"]);
    }])->select($columns)->get();
  }

  public function getLeastRoll(int $limit = 5, array $columns = ["*"])
  {
    return Roll::with("unit")
      ->orderBy("quantity_unit", "ASC")
      ->limit($limit)
      ->get($columns);
  }

  public function getDataRollByIds(array $ids, array $columns = ["*"])
  {
    return Roll::select($columns)->whereIn("id", $ids)->get();
  }

  public function addNewDataRoll(array $requestedData):object
  {
    return Roll::create($requestedData);
  }

  public function getDataRollById(int $id, array $columns = ["*"]):?object
  {
    return Roll::with("unit")->select($columns)->find($id);
  }

  public function updateDataRollById(int $id, array $requestedData):bool
  {
    return Roll::where("id", $id)->update($requestedData);
  }

  public function increaseQuantityRollAndUnit(int $id,int $quantityRoll=0, int $quantityUnit = 0)
  {
    return Roll::where("id", $id)->update([
      "quantity_roll" => DB::raw("quantity_roll+$quantityRoll"),
      "quantity_unit" => DB::raw("quantity_unit+$quantityUnit"),
    ]);
  }

  public function decreaseQuantityRollAndUnit(int $id,int $quantityRoll=0, int $quantityUnit = 0)
  {
    return Roll::where("id", $id)->update([
      "quantity_roll" => DB::raw("quantity_roll-$quantityRoll"),
      "quantity_unit" => DB::raw("quantity_unit-$quantityUnit"),
    ]);
  }
}

?>