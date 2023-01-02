<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistorySoldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

/// register
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('update_check',[AuthController::class,'update_check']);
Route::post('upload',[ImageController::class,'upload']);

Route::middleware('auth:sanctum')->group(function (){
/// register auth
    Route::get( 'me',[AuthController::class,'user']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('update_password',[AuthController::class,'update_password']);
///Banner
    Route::get('banner/index',[CategoryController::class,'banner_index']);
///News
    Route::get('news',[HomeController::class,'news']);


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
    Route::get('history/all',[HistorySoldController::class,'historyAll']);
    Route::get('history/accepted',[HistorySoldController::class,'history_accepted']);
    Route::delete('history/delete',[HistorySoldController::class,'history_delete']);
    Route::post('history/sold',[HistorySoldController::class,'create']);

///search
    Route::get('search',[ProductController::class,'search']);
    Route::get('discount',[ProductController::class,'discount']);

    /// admin
    Route::prefix('/admin')->group(function () {
    Route::get( '/users/index',[UserController::class,'index']);
    Route::post('/users/update',[UserController::class,'update_role']);
    Route::get('/users/search',[UserController::class,'user_search']);
    Route::get('/users/month_price',[UserController::class,'userMonthPrice']);
    Route::get( '/product/index',[ProductController::class,'index_all']);
    Route::post('/product/create',[ProductController::class,'create_product']);
    Route::post('/product/update',[ProductController::class,'update_product']);
    Route::post('/product/update_str',[ProductController::class,'update_productNoImage']);
    Route::delete('/product/delete',[ProductController::class,'delete_product']);
    Route::post('/category/add',[CategoryController::class,'category_add']);
    Route::post('/category/update',[CategoryController::class,'category_update']);
    Route::post('/category/update_str',[CategoryController::class,'category_updateNoImage']);
    Route::delete('/category/delete',[CategoryController::class,'delete_category']);
    Route::post('/banner/add',[CategoryController::class,'banner_add']);
    Route::post('/banner/update',[CategoryController::class,'banner_update']);
    Route::delete('/banner/delete',[CategoryController::class,'banner_delete']);
    Route::post('news/add',[HomeController::class,'news_add']);
    Route::post('news/update',[HomeController::class,'news_update']);
    Route::post('news/update_str',[HomeController::class,'new_updateNoImage']);
    Route::delete('news/delete',[HomeController::class,'news_delete']);
    Route::post('order/accept',[HistorySoldController::class,'order_accept']);
    Route::post('history/cash',[HistorySoldController::class,'today_cash']);
    Route::delete('history/day/delete',[HistorySoldController::class,'delete_historyDay']);
    });

});
