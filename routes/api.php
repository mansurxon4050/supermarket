<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('update_check',[AuthController::class,'update_check']);
Route::post('update_password',[AuthController::class,'update_password']);
Route::post('upload',[ImageController::class,'upload']);

Route::get('products',[ProductController::class,'index']);

Route::get('banner',[HomeController::class,'index']);
Route::get('star',[HomeController::class,'star']);


Route::get('waters',[WaterController::class,'service']);

Route::middleware('auth:sanctum')->group(function (){

    Route::get('me',[AuthController::class,'user']);
    Route::post('logout',[AuthController::class,'logout']);

   // Route::apiResource('waters',WaterController::class);
    /*
    Route::get('users',[UserController::class,'index']);
    Route::post('users',[UserController::class,'store']);
    Route::get('users/{id}',[UserController::class,'show']);
    Route::put('users/{id}',[UserController::class,'update']);
    Route::delete('users/{id}',[UserController::class,'destroy']);*/


});
