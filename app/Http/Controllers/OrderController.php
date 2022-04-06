<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function create(Order $order)
    {
        $order->save();
    }

    public function addToOrder(Order $order)
    {
    }

    public function show()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        return view('order', ['orders' => $orders]);
    }

    public function destroy($order_id, $food_id)
    {
        $order = Order::findOrFail($order_id);
        $order->food()->detach($food_id);
        return redirect('/order');
    }

    public function updateCart(Request $req)
    {
        // $order = session()->get('cart');
        // $order = $req->id;
        // session()->forget('cart');
        $item = [
            'id' => $req->id,
            'name' => $req->name,
            'price' => $req->price,
            'picture' => $req->picture,
            'quantity' => $req->quantity,
        ];
        // $food = Food::findOrFail($req['id']);
        // $order->food()->attach($food, ['quantity' => $req['quantity']]);
        // $order->deliveryAddress = 'aaa';
        Session::push('cart', $item);
        session()->flash('success', 'added to cart');

        return '/food/show';
    }
}
