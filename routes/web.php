<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');
Route::view('/home', 'home');
Auth::routes();

Route::get('logout', [LoginController::class,'logout']);

Route::view('order', 'order');