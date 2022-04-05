<?php

namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index() {
        $food = Food::all();
        return view('food.index', ['food' => $food]);
    }

    public function destroy(Food $food) {
        $food->delete();
        return redirect('/food/index');
    }

    public function create(Food $food)
    {
        $food->save();
    }

    public function update(Food $food)
    {
        Food::where('id', $food['id'])->update(['name'=>'Updated title']);
    }
}
