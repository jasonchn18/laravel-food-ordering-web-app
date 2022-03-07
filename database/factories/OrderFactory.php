<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'date' => $this->faker->date(),
            'type' => $this->faker->randomElement(['pickup', 'delivery']),
            'deliveryAddress' => $this->faker->address(),
        ];
    }
}

