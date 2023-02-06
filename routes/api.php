<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[\App\Http\Controllers\Api\AuthController::class,'register']);
Route::post('login',[\App\Http\Controllers\Api\AuthController::class,'login']);

// BannerApi
Route::apiResource('/banner',\App\Http\Controllers\Api\BannerController::class)->middleware('auth:api');

// BrandApi
Route::get('/brands',[\App\Http\Controllers\Api\FrontendController::class,'brands']);

//CategoryApi
Route::get('categories',[\App\Http\Controllers\Api\CategoryController::class,'categories']);

//featured category
Route::get('featured-category',[\App\Http\Controllers\Api\CategoryController::class,'featuredCategory']);

//couponApi
Route::get('coupons',[\App\Http\Controllers\Api\FrontendController::class,'coupons']);

//orderApi
Route::get('orders',[\App\Http\Controllers\Api\FrontendController::class,'orders']);

//ProductApi
Route::get('products',[\App\Http\Controllers\Api\ProductController::class,'products']);
//Deal of the day
Route::get('deal_of_the_day',[\App\Http\Controllers\Api\ProductController::class,'dealOfTheDay']);
// featured products
Route::get('featured-products',[\App\Http\Controllers\Api\ProductController::class,'featuredProducts']);
// new products
Route::get('new-products',[\App\Http\Controllers\Api\ProductController::class,'newProducts']);
// hot products
Route::get('hot-products',[\App\Http\Controllers\Api\ProductController::class,'hotProducts']);

//search product
Route::get('search-product',[\App\Http\Controllers\Api\ProductController::class,'searchProduct']);

//product detail
Route::get('product-detail',[\App\Http\Controllers\Api\ProductController::class,'productDetail']);

// cartApi section
Route::get('user/get-cart',[\App\Http\Controllers\Api\CartController::class,'userGetCart']);
Route::post('user/add-to-cart',[\App\Http\Controllers\Api\CartController::class,'addToCart']);

//settings
Route::get('settings',[\App\Http\Controllers\Api\FrontendController::class,'settings']);
Route::group(['middleware'=>['auth:api']],function (){
    Route::post('logout',[\App\Http\Controllers\Api\AuthController::class,'logout']);

    //product review
    Route::post('user/review',[\App\Http\Controllers\Api\ProductController::class,'reviewSubmit']);

    //Userorder
    Route::get('user/orders',[\App\Http\Controllers\Api\UserController::class,'userOrder']);
    //user order detail
    Route::get('user/order/{orderId}',[\App\Http\Controllers\Api\UserController::class,'userOrderDetail']);


});

