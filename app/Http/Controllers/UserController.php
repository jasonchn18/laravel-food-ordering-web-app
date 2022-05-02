<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function update(Request $user)
    {

        $id = Auth::id();
        $user->validate([
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            'address' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' => $user['name'],
            'email' => $user['email'],
            'address' => $user['address'],
        ]);

        Session::flash('success', 'Successfully edited the user.');
        return redirect('/home');
    }

    public function updateView()
    {
        if (!Auth::check()) {
            session()->flash('unauthorized', 'You are not authorized to access the page ' . request()->path());
            return redirect('../home');
        }
        $user = User::findOrFail(Auth::id());
        return view('editUser', ['user' => $user]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $orders = Order::where('user_id', $id)->get();
        // For each food in the order:
        foreach ($orders as $order) {
            foreach ($order->food as $food){
                // Remove from pivot table
                $order->food()->detach($food->id);
            }
            $order->delete();
        }
        Session::flash('success', 'Successfully deleted your account.');
        return redirect('logout');
    }
}
