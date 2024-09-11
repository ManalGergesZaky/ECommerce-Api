<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController ;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
], function ($router) {

    Route::post('/login', [AuthController::class , "login"])->name('login');
    Route::post('/register', [AuthController::class , "register"]); 
    Route::post('/logout', [AuthController::class , "logout"]); 
    Route::post('/userProfile', [AuthController::class , "user_profile"]); 
    Route::post('/refresh', [AuthController::class , "refresh_token"]); 

});

Route::post('forgotPassword',[ForgotPasswordController::class,'forgotPassword']);
Route::post('resetPassword',[ResetPasswordController::class,'resetPassword']);

Route::middleware(['check_token'])->group(function () {
//Products Route
Route::get('/products', [ProductController::class, "index"]);
Route::post('/products',[ProductController::class , 'store']);
Route::get('/products/{product}',[ProductController::class , 'show']);
Route::delete('/products/{product}',[ProductController::class , 'destroy']);
Route::get('/products/{product}/edit',[ProductController::class , 'edit']);
Route::put('/products/{product}',[ProductController::class , 'update']);
//Category Route
Route::get('/categories', [CategoryController::Class, "index"]);
Route::get('/categories/{category}', [CategoryController::Class, "show"]);
Route::post('/categories', [CategoryController::Class, "store"]);
Route::get('/categories/{category}/edit',[CategoryController::class , 'edit']);
Route::put('/categories/{category}',[CategoryController::class , 'update']);
Route::delete('/categories/{category}',[CategoryController::class , 'destroy']);
//User Route
Route::get('/users', [Users::Class, "index"]);
Route::get('/users/{user}', [Users::Class, "show"]);
Route::post('/users', [Users::Class, "store"]);
Route::get('/users/{user}/edit',[Users::class , 'edit']);
Route::put('/users/{user}',[Users::class , 'update']);
Route::delete('/users/{user}',[Users::class , 'destroy']);
//Cart Route
Route::post('/carts',[CartController::class , 'store']);
Route::get('/carts',[CartController::class , 'index']);
Route::get('/carts/{cart}',[CartController::class , 'show']);
Route::put('/carts/{cart}',[CartController::class , 'update']);
Route::delete('/carts/{cart}',[CartController::class , 'destroy']);
//Cart Detailes Route
Route::get('/cartDetailes',[CartDetailController::class , 'index']);
Route::post('/cartDetailes',[CartDetailController::class , 'store']);
Route::get('/cartDetailes/{cart}',[CartDetailController::class , 'show']);
Route::put('/cartDetailes/{cart}',[CartDetailController::class , 'update']);
Route::delete('/cartDetailes/{cart}',[CartDetailController::class , 'destroy']);
//Order Route
Route::get('/orders', [OrderController::class ,'index']);
Route::post('/orders', [OrderController::class ,'store']);
Route::get('/orders/{order}', [OrderController::class ,'show']);
Route::put('/orders/{order}', [OrderController::class ,'update']);
Route::delete('/orders/{order}', [OrderController::class ,'destroy']);
//Order Details Route
Route::get('/ordersDetails', [OrderDetailController::class ,'index']);
Route::post('/ordersDetails', [OrderDetailController::class ,'store']);
Route::get('/ordersDetails/{order}', [OrderDetailController::class ,'show']);
Route::put('/ordersDetails/{order}', [OrderDetailController::class ,'update']);
Route::delete('/ordersDetails/{order}', [OrderDetailController::class ,'destroy']);

});

