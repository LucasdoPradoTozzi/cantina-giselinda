<?php

use App\Http\Controllers\BuyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('dashboard');
});


//PRODUCTS ROUTES
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/new', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products/{id}', [ProductController::class, 'update']);
Route::post('/products/{id}/delete', [ProductController::class, 'delete']);

//STOCK
Route::get('/stock', [StockController::class, 'index']);
Route::get('/stock/{id}', [StockController::class, 'getStockByProductId']);

//BUYS
Route::get('/buys', [BuyController::class, 'index']);
Route::get('/buys/new', [BuyController::class, 'create']);
Route::get('/buys/{id}', [BuyController::class, 'show']);
Route::post('/buys', [BuyController::class, 'store']);

//SELLS
Route::get('/sells/new', [SellController::class, 'create']);
Route::get('/sells', [SellController::class, 'index']);
Route::post('/sells', [SellController::class, 'store']);
Route::get('/sells/{id}', [SellController::class, 'show']);
