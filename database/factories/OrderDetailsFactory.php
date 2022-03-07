<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'orderID' => \App\Models\Order::all()->random()->id,
            'foodID' => \App\Models\Food::all()->random()->id,
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
