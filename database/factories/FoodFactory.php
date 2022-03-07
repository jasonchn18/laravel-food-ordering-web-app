<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'price' => $this->faker->numberBetween(5, 20),
            'description' => $this->faker->text(),
            'type' => $this->faker->randomLetter(),
            'picture' => $this->faker->image(),
        ];
    }
}
