<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FoodOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = \App\Models\Order::all()->random(10);
        $food = \App\Models\Food::all()->random(10);
        $orders->each(function (\App\Models\Order $r) use ($food) {
            $r->food()->attach(
                $food->random(rand(1, 5))->pluck('id')->toArray(),
                ['quantity' => rand(1, 5)]
            );
        });
    }
}
