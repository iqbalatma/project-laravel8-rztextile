<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UnitSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            InvoiceSeeder::class,
            CustomerSegmentationSeeder::class,
            RollSeeder::class,
            PromotionMessageSeeder::class,
        ]);
    }
}
