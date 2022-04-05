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
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        return [
            'name' => $this->faker->unique()->foodName(),
            'price' => $this->faker->numberBetween(5, 20),
            'description' => $this->faker->sentence(6, true),
            'type' => $this->faker->randomElement(['Western', 'Chinese', 'Japanese']),
            'picture' => $this->faker->imageUrl(640, 480),
        ];
    }
}
