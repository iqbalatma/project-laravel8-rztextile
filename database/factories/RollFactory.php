<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $basicPrice = $this->faker->numberBetween(100, 10000);
        return [
            "code" => Str::random(8),
            "name" => $this->faker->name(),
            "quantity_roll" => $this->faker->numberBetween(1, 100),
            "quantity_unit" => $this->faker->numberBetween(1, 100),
            "qrcode" => Str::random(8),
            "basic_price" => $basicPrice,
            "selling_price" => $basicPrice + 200,
            "qrcode_image" => null,
            "unit_id" => $this->faker->numberBetween(1, 3)
        ];
    }
}
