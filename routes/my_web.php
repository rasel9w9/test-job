<?php

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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return redirect("/home");
});


Route::get('/product-entry', [App\Http\Controllers\HomeController::class, 'productEntry'])->name('productEntry');
Route::post('/save-product', [App\Http\Controllers\HomeController::class, 'saveProduct'])->name('saveProduct');

Route::get('/order-list', [App\Http\Controllers\HomeController::class, 'orderList'])->name('orderList');
Route::post('/save-order', [App\Http\Controllers\HomeController::class, 'saveOrder'])->name('saveOrder');

Route::get('/point-of-sale', [App\Http\Controllers\HomeController::class, 'pointOfSale'])->name('pointOfSale');
