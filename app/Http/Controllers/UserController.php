<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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

        return redirect('/home');
    }

    public function updateView()
    {
        if (!Auth::check()) {
            session()->flash('unauthorized', 'You are not authorized to access the page ' . request()->path());
            return redirect('../home');
        }
        return view('editUser');
    }
}
