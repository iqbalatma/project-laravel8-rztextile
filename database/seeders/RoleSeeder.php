<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                "name" => "administrator",
                "description" => "user that has all access"
            ],
            [
                "name" => "administrasi",
                "description" => "user that act as stock checking"
            ],
            [
                "name" => "kasir",
                "description" => "user that act as cashier"
            ],
            [
                "name" => "customer",
                "description" => "user that act as buyer items"
            ],
        ];

        foreach ($data as $key => $item) {
            Role::create($item);
        }
    }
}
