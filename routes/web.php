<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');
Auth::routes();
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);

Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);

Route::post('/register/admin', [RegisterController::class,'createAdmin']);

Route::group(['middleware' => 'auth:admin'], function () {
 Route::view('/admin', 'admin');
});
Route::get('logout', [LoginController::class,'logout']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('order', 'order');

// food routes with policy
Route::get('/food/show', [FoodController::class, 'index']);
Route::post('/food/create', [FoodController::class, 'create']);
Route::put('/food/{food}', [FoodController::class, 'update']);
Route::delete('/food/{food}', [FoodController::class, 'destroy']);