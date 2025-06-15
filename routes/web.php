<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return "hello world";
});

// Route::get('/login', Login::class)->name('login');
// Route::get('/register', CreateUser::class)->name('register');


// Route::middleware('auth')->group(function () {
//     Route::get('/', Dashboard::class)->name('dashboard');

//     // USER PROFILE
//     Route::get('/profile', function () {
//         return view('profile');
//     })->name('profile');

//     // USER ADMIN
//     Route::get('/users/approval', function () {
//         return view('users-approval');
//     })->name('users.approval');

//     //PRODUCTS ROUTES
//     Route::get('/products', ProductsIndex::class)->name('products.index');
//     Route::get('/products/new', CreateProduct::class);
//     Route::post('/products', [ProductController::class, 'store']);
//     Route::get('/products/{id}', [ProductController::class, 'show']);
//     Route::post('/products/{id}', [ProductController::class, 'update']);
//     Route::post('/products/{id}/delete', [ProductController::class, 'delete']);
//     Route::get('/products/{product}/edit', EditProduct::class)->name('products.edit');


//     //PRODUCTS ROUTES
//     Route::get('/product-types', ProductTypesIndex::class)->name('productTypes.index');
//     Route::get('/product-type/new', CreateProductType::class)->name('productTypes.create');
//     Route::get('/product-type/{productType}/edit', EditProductType::class)->name('productTypes.edit');

//     //STOCK
//     Route::get('/stock', StockIndex::class)->name('stock.index');

//     //BUYS
//     Route::get('/buys', BuysIndex::class)->name('buys.index');
//     Route::get('/buys/new', CreateBuy::class);
//     Route::get('/buys/{id}', BuysShow::class)->name('buys.show');
//     Route::post('/buys', [BuyController::class, 'store']);

//     //SELLS
//     Route::get('/sells/new', CreateSell::class)->name('sells.create');
//     Route::get('/sells', SellIndex::class)->name('sells.index');
//     Route::get('/sells/{id}', ShowSell::class)->name('sells.show');

//     //WASTES
//     Route::get('/wastes/new', [WasteController::class, 'create']);
//     Route::get('/wastes', [WasteController::class, 'index']);
//     Route::post('/wastes', [WasteController::class, 'store']);
//     Route::get('/wastes/{id}', [WasteController::class, 'show']);

//     //WASTE REASONS
//     Route::get('/waste-reasons/new', WasteReasonCreate::class)->name('waste-reasons.create');
//     Route::get('/waste-reasons', WasteReasonIndex::class)->name('waste-reasons.index');
//     Route::get('/waste-reasons/{wasteReason}/edit', EditWasteReason::class)->name('waste-reasons.edit');

//     //CUSTOMERS
//     Route::get('/customers', CustomerIndex::class)->name('customer.index');
//     Route::get('/customers/new', CustomerCreate::class)->name('customer.create');
//     Route::get('/customers/{id}', CustomerShow::class)->name('customer.show');

//     //DASHBOARD
//     Route::get('/dashboard/best-sellers', [DashboardController::class, 'getTopFiveBestSellers']);
//     Route::get('/dashboard/worst-losses', [DashboardController::class, 'getWorstLosses']);
// });
