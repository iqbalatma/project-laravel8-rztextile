<?php

namespace Database\Seeders;

use App\Models\Roll;
use Illuminate\Database\Seeder;

class RollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roll::factory()->count(100)->create();
    }
}
