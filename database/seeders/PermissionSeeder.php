<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Statics\Permissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();
        foreach ((new \ReflectionClass(Permissions::class))->getConstants() as $key => $value) {
            foreach ($value as $subKey => $subValue) {
                Permission::create($subValue);
            }
        }
    }
}
