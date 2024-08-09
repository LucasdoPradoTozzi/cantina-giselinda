<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\WasteController;

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

//PRODUCTS ROUTES
Route::get('/product-types', [ProductTypeController::class, 'index'])->name('productTypes.index');
Route::get('/product-type/new', [ProductTypeController::class, 'create']);
Route::post('/product-type', [ProductTypeController::class, 'store']);
Route::get('/product-type/{id}', [ProductTypeController::class, 'show']);
Route::post('/product-type/{id}', [ProductTypeController::class, 'update']);

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

//WASTES
Route::get('/wastes/new', [WasteController::class, 'create']);
Route::get('/wastes', [WasteController::class, 'index']);
Route::post('/wastes', [WasteController::class, 'store']);
Route::get('/wastes/{id}', [WasteController::class, 'show']);



//DASHBOARD
Route::get('/dashboard/best-sellers', [DashboardController::class, 'getTopFiveBestSellers']);
