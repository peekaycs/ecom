<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\CartStorageNewController;

Route::get('/', function(){
    return view('front.index');
});

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/product', [ProductController::class,'product'])->name('product');
Route::get('/product-detail/{slug}', [ProductController::class,'product_detail'])->name('product_detail');

Route::get('/cart-list', [CartStorageNewController::class,'cart_list'])->name('cart_list');
Route::post('/add-to-cart', [CartStorageNewController::class,'AddToCart'])->name('AddToCart');
