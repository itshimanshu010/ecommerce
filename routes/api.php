<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;



Route::get("/test",function(){
    p("working");
});

Route::group(['middleware' => 'api'], function ($routes) {
    Route::post('/userRegister', [AuthController::class, 'userRegister']);
    Route::post('/userApiLogin', [AuthController::class, 'userApiLogin']);
    Route::post('/userProfile', [AuthController::class, 'userProfile']);

});


Route::post("user/store",[UserController::class,'store']);
Route::get("user/{id}", [UserController::class, 'index']);
Route::delete("user/{id}", [UserController::class, 'destroy']);
Route::put("user/update/{id}", [UserController::class, 'update']);
Route::get("user", [UserController::class, 'user']);


Route::get('/products/{id}', [ProductController::class, 'index']);
Route::get("products", [ProductController::class, 'product']);
Route::post("products/store",[ProductController::class,'store']);
Route::delete("products/{id}", [ProductController::class, 'destroy']);
Route::put("products/update/{id}", [ProductController::class, 'update']);
