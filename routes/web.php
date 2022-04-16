<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [FoodController::class, 'index']);
Auth::routes();

Route::get('logout', [LoginController::class, 'logout']);

// food routes with policy
Route::get('/updatefood/{food}', [FoodController::class, 'getForUpdate'])->middleware('protected');
Route::get('/home', [FoodController::class, 'index']);
Route::get('/home/{type}', [FoodController::class, 'filter']);
Route::get('/food/viewfood', [FoodController::class, 'adminIndex'])->middleware('protected');
Route::view('/food/addfood', 'food.addfood')->middleware('protected');
Route::post('/food/create', [FoodController::class, 'create']);
Route::get('/food/{food}', [FoodController::class, 'show']);
Route::post('/food/{food}', [FoodController::class, 'update']);
Route::delete('/food/{food}', [FoodController::class, 'destroy']);
Route::post('/food/addfood', [FoodController::class, 'create']);


// Order routes
Route::get('order', [OrderController::class, 'show']);
Route::delete('/order/{order_id}', [OrderController::class, 'destroy']);

// Cart routes
Route::view('cart', 'cart');
Route::post('/addToCart', [OrderController::class, 'updateCart']);
Route::delete('/cart/remove/{food_id}', [OrderController::class, 'removeFromCart']);
Route::post('/cart/placeorder', [OrderController::class, 'placeOrder']);

Route::post('/user/edit', [UserController::class, 'update']);
Route::get('/user/edit', [UserController::class, 'updateView']);
Route::delete('/user/{user}', [UserController::class, 'delete']);



