<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\RetailerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/signup', [ActivityController::class, 'signUpPage'])->name('signup');
Route::post('/signup-submit', [ActivityController::class, 'signUpPost'])->name('signup.post');
Route::get('/login', [ActivityController::class, 'loginPage'])->name('login');
Route::get('/retailer/dashboard', [RetailerController::class, 'dashboard'])->name('retailer.dashboard');


Route::get('/dealer/dashboard', [DealerController::class, 'dashboard'])->name('dealer.dashboard');
Route::get('/dealer/items', [DealerController::class, 'items'])->name('dealer.items');
Route::get('/dealer/add-product', [DealerController::class, 'addProductView'])->name('dealer.add_product_view');