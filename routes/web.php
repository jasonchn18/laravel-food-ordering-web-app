<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::view('/', 'welcome');
Route::get('/', [FoodController::class, 'index']);
//Route::get('/{type}', [FoodController::class, 'filter']);
// Route::view('/home', 'home');
Route::view('/addfood', 'food.addfood');
Auth::routes();

Route::get('logout', [LoginController::class, 'logout']);

// food routes with policy
Route::get('/updatefood/{food}', [FoodController::class, 'getForUpdate']);
Route::get('/home', [FoodController::class, 'index']);
Route::get('/home/{type}', [FoodController::class, 'filter']);
Route::get('/food/viewfood', [FoodController::class, 'adminIndex']);
Route::post('/food/create', [FoodController::class, 'create']);
Route::get('/food/{food}', [FoodController::class, 'show']);
Route::post('/food/{food}', [FoodController::class, 'update']);
Route::delete('/food/{food}', [FoodController::class, 'destroy']);

// Order routes
Route::get('order', [OrderController::class, 'show']);
Route::delete('/order/{order_id}/{food_id}', [OrderController::class, 'destroy']);

// Cart routes
Route::view('cart', 'cart');
Route::post('/addToCart', [OrderController::class, 'updateCart']);
Route::delete('/cart/remove/{food_id}', [OrderController::class, 'removeFromCart']);
Route::post('/cart/placeorder', [OrderController::class, 'placeOrder']);
