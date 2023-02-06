<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Clear Cache
Route::get('clear',function (){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return back()->with('success','Successfully cleared cache');
})->name('clear.cache');


//Currency change
Route::post('currency',[\App\Http\Controllers\CurrencyController::class,'currencyChange'])->name('currency.change');


//Frontend section

require __DIR__ . '/frontend.php';



//Endfrontend section

// Backend section

require __DIR__ . '/backend.php';


Auth::routes();


//User Dashboard
Route::group(['prefix'=>'user','middleware'=>'auth'],function (){
    Route::get('/dashboard',[\App\Http\Controllers\Frontend\UserManagerController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/order',[\App\Http\Controllers\Frontend\UserManagerController::class,'userOrder'])->name('user.order');
    Route::get('/order-cancel/{id}',[\App\Http\Controllers\Frontend\UserManagerController::class,'orderCancelUser'])->name('order.cancel.user');
    Route::get('/address',[\App\Http\Controllers\Frontend\UserManagerController::class,'userAddress'])->name('user.address');
    Route::get('/account-detail',[\App\Http\Controllers\Frontend\UserManagerController::class,'userAccount'])->name('user.account');

    Route::post('/billing/address/{id}',[\App\Http\Controllers\Frontend\UserManagerController::class,'billingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}',[\App\Http\Controllers\Frontend\UserManagerController::class,'shippingAddress'])->name('shipping.address');

    Route::post('/update/account/{id}',[\App\Http\Controllers\Frontend\UserManagerController::class,'updateAccount'])->name('update.account');
});
