<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Order $order)
    {
        $order->save();
    }

    public function addToOrder(Order $order)
    {
    }
}
