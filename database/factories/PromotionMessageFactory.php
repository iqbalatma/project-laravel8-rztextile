<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "message" => $this->faker->text(),
            "customer_segmentation_id" => $this->faker->numberBetween(1, 4),
            "discount" => $this->faker->numberBetween(1, 100),
        ];
    }
}
