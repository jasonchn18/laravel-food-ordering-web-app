<?php

namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index() {
        $foods = Food::paginate(10);
        return view('food.viewfood',  ['foods'=> $foods]);
    }

    public function show($id) {
        $food = Food::find($id);
        return view('food.show', ['food' => $food]);
    }

    public function destroy(Request $food) {
        $food->delete();
        return redirect('/food/addfood');
    }

    public function create(Request $food)
    {
        Food::create($food->all());
        return redirect('/food/addfood');
    }

    public function update(Request $food)
    {
        Food::where('id', $food['id'])->update(['name'=>'Updated title',]);
    }
}
