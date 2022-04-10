<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::paginate(12);
        return view('food.home',  ['foods' => $foods]);
    }
    public function filter($type)
    {


        $foods = Food::where('type', '=', $type)->paginate(12);

        return view('food.home',  ['foods' => $foods]);
    }

    public function adminIndex()
    {
        $foods = Food::paginate(10);
        return view('food.viewfood',  ['foods' => $foods]);
    }

    public function show($id)
    {
        $food = Food::findOrFail($id);
        return view('food.show', ['food' => $food]);
    }

    public function getForUpdate($id)
    {
        $food = Food::findOrFail($id);
        return view('food.updatefood', ['food' => $food]);
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        return redirect('/food/viewfood');
    }

    public function create(Request $food)
    {
        $food->validate([
            'name' => 'required | unique:food',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
            'picture' => 'required'
        ]);
        Food::create($food->all());
        return redirect('/food/viewfood');
    }

    public function update(Request $food, $id)
    {
        $food->validate([
            'name' => 'required | unique:food',
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
            'picture' => 'required'
        ]);
        Food::where('id', $id)->update([
            'name' => $food['name'],
            'description' => $food['description'],
            'price' => $food['price'],
            'type' => $food['type'],
            'picture' => $food['picture'],
        ]);
        return redirect('/food/viewfood');
    }
}
