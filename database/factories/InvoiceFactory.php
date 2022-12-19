<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "code"              => "",
            "total_capital"     => $this->faker->numberBetween(100, 1000000),
            "total_bill"        => $this->faker->numberBetween(100, 1000000),
            "total_profit"      => $this->faker->numberBetween(100, 1000000),
            "total_paid_amount" => $this->faker->numberBetween(100, 1000000),
            "bill_left"         => $this->faker->numberBetween(100, 1000000),
            "is_paid_off"       => $this->faker->boolean(),
            "customer_id"       => $this->faker->numberBetween(86, 115),
            "user_id"           => 1,
            "created_at"        => $this->faker->dateTimeBetween("01-12-2022", "30-12-2022")
        ];
    }
}
