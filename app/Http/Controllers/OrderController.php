<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // dd($orders[0]->id);
        // dd($orders[0]->food);
        // dd($order->food());
        return view('order', ['orders' => $orders]);
    }

    public function destroy($order_id, $food_id)
    {
        $order = Order::findOrFail($order_id);
        // dd($order_id, $food_id);
        $order->food()->detach($food_id);
        // return 204; // 204 is successful delete status code
        // $post->delete();
        return redirect('/order');
    }
}
