<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistorySoldController;
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

Route::post('history/sold',[HistorySoldController::class,'create']);

/// category
Route::get('category/products',[ProductController::class,'index']);
Route::get('category',[CategoryController::class,'index']);

/// home
Route::get('product/popular',[HomeController::class,'popular']);
Route::get('product/images',[HomeController::class,'images']);
Route::get('product/item',[ProductController::class,'item']);


/// star add
Route::post('product/star/add',[ProductController::class,'star_add']);



/// favorite
Route::post('product/favorite/add',[UserController::class,'favorite_add']);
Route::get('product/favorite/index',[UserController::class,'favorite_index']);
Route::delete('product/favorite/delete',[UserController::class,'favorite_delete']);

/// history
Route::get('history/index',[HistorySoldController::class,'history_index']);
Route::delete('history/delete',[HistorySoldController::class,'history_delete']);
///search
Route::get('search',[ProductController::class,'search']);
Route::get('discount',[ProductController::class,'discount']);

// person
Route::get('news',[HomeController::class,'news']);

/// register
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('update_check',[AuthController::class,'update_check']);
Route::post('update_password',[AuthController::class,'update_password']);
Route::post('upload',[ImageController::class,'upload']);

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
