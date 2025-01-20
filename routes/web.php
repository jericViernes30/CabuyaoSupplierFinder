<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RetailerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('index');

Route::get('/signup', [ActivityController::class, 'signUpPage'])->name('signup');
Route::post('/signup-submit', [ActivityController::class, 'signUpPost'])->name('signup.post');
Route::get('/login', [ActivityController::class, 'loginPage'])->name('login');
Route::get('/dealer/login', [ActivityController::class, 'dealerLogin'])->name('dealer.login');


Route::post('/dealer/auth', [DealerController::class, 'loginDealer'])->name('dealer.auth');
Route::post('/dealer/logout', [DealerController::class, 'logout'])->name('dealer.logout');
Route::get('/dealer/signup', [DealerController::class, 'signUpDealer'])->name('dealer.signup');
Route::get('/dealer/dashboard', [DealerController::class, 'dashboard'])->name('dealer.dashboard');
Route::get('/dealer/items', [DealerController::class, 'items'])->name('dealer.items');
Route::get('/dealer/add-product', [DealerController::class, 'addProductView'])->name('dealer.add_product_view');
Route::get('/dealer/orders', [DealerController::class, 'orders'])->name('dealer.orders');
Route::post('/dealer/order-details', [DealerController::class, 'getOrderDetails'])->name('dealer.order.details');
Route::post('/dealer/mark-order-delivered', [DealerController::class, 'markOrderDelivered'])->name('dealer.order.delivered');
Route::post('/dealer/add-product', [ProductController::class, 'addProduct'])->name('dealer.product.add');




Route::get('/retailer/dashboard', [RetailerController::class, 'dashboard'])->name('retailer.dashboard');
Route::post('/retailer/signup', [RetailerController::class, 'signUpUser'])->name('retailer.signup');
Route::post('/retailer/auth', [RetailerController::class, 'loginUser'])->name('retailer.auth');
Route::post('/retailer/logout', [RetailerController::class, 'logout'])->name('retailer.logout');



Route::post('/retailer/add-to-cart', [OrderController::class, 'addToCart'])->name('retailer.cart.add');
Route::post('/retailer/add-to-orders', [OrderController::class, 'addToOrders'])->name('retailer.order.add');
Route::get('/retailer/cart', [RetailerController::class, 'cart'])->name('retailer.cart');
Route::get('/retailer/orders', [RetailerController::class, 'orders'])->name('retailer.order');
Route::get('/retailer/rice/live-search', [ProductController::class, 'liveSearch'])->name('rice.livesearch');
Route::POST('/retailer/distance', [RetailerController::class, 'filterRiceItems'])->name('retailer.distance');