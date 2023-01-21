<?php

namespace Database\Seeders;

use App\Models\PromotionMessage;
use Illuminate\Database\Seeder;

class PromotionMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PromotionMessage::factory()->count(20)->create();
    }
}
