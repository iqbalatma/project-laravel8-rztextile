<?php

namespace Database\Seeders;

use App\Models\CustomerSegmentation;
use Illuminate\Database\Seeder;

class CustomerSegmentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "key" => "mvc",
                "name" => "most valueable customers"
            ],
            [
                "key" => "mgc",
                "name" => "most growthable customers"
            ],
            [
                "key" => "m",
                "name" => "migration customers"
            ],
            [
                "key" => "bz",
                "name" => "bellow zero customer"
            ],
        ];

        foreach ($data as $key => $value) {
            CustomerSegmentation::create($value);
        }
    }
}
