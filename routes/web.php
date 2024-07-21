<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


//PRODUCTS ROUTES
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/new', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products/{id}', [ProductController::class, 'update']);
Route::post('/products/{id}/delete', [ProductController::class, 'delete']);
