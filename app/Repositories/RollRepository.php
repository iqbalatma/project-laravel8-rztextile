<?php

namespace App\Repositories;

use App\AppData;
use App\Models\Roll;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelExtend\BaseRepository;

class RollRepository extends BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new Roll();
    }
    public function getAllDataRollPaginated(
        string|bool $search = false,
        string|bool $year = false,
        string|bool $month = false,
        array $columns = ["*"],
        int $perPage = AppData::DEFAULT_PERPAGE
    ): ?object {
        $rolls = $this->model->select($columns);

        if ($year && $month) {
            $rolls->whereYear("updated_at", "=", $year)->whereMonth("updated_at", "=", $month);
        }

        if ($search) {
            $rolls->where("name", "LIKE", "%$search%")
                ->orWhere("code", "LIKE", "%$search%")
                ->orWhere("qrcode", "LIKE", "%$search%")
                ->orWhereHas("unit", function ($query) use ($search, $year, $month) {
                    $query->where("name", "LIKE", "%$search%");

                    if ($year && $month) {
                        $query->whereHas(
                            "roll",
                            function ($subquery) use ($year, $month) {
                                $subquery->whereYear("updated_at", "=", $year)->whereMonth("updated_at", "=", $month);
                            }
                        );
                    }
                });
        }

        $rolls = $rolls->paginate($perPage)->appends(request()->query());

        return $rolls;
    }


    public function getAllDataRoll(array $columns = ["*"])
    {
        return $this->model->select($columns)->with([
            "unit" => function ($query) {
                $query->select(["id", "name"]);
            }
        ])->get();
    }

    public function getLeastRoll(int $limit = 5, array $columns = ["*"])
    {
        return $this->model->with("unit")
            ->orderBy("quantity_unit", "ASC")
            ->limit($limit)
            ->get($columns);
    }

    public function getDataRollByIds(array $ids, array $columns = ["*"])
    {
        return $this->model->select($columns)->whereIn("id", $ids)->get();
    }

    public function increaseQuantityRollAndUnit(int $id, int $quantityRoll = 0, int $quantityUnit = 0)
    {
        return $this->model->where("id", $id)->update([
            "quantity_roll" => DB::raw("quantity_roll+$quantityRoll"),
            "quantity_unit" => DB::raw("quantity_unit+$quantityUnit"),
        ]);
    }

    public function decreaseQuantityRollAndUnit(int $id, int $quantityRoll = 0, int $quantityUnit = 0)
    {
        return $this->model->where("id", $id)->update([
            "quantity_roll" => DB::raw("quantity_roll-$quantityRoll"),
            "quantity_unit" => DB::raw("quantity_unit-$quantityUnit"),
        ]);
    }
}
