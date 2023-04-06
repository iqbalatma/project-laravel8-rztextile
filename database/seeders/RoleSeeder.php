<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Statics\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();
        foreach ((new \ReflectionClass(Roles::class))->getConstants() as $key => $value) {
            Role::create(["name" => $value]);
        }
    }
}
