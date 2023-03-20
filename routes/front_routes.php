<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function(){
    return view('front.index');
});

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/product', [ProductController::class,'product'])->name('product');
Route::get('/product-detail/{id}', [ProductController::class,'product_detail'])->name('product_detail');

Route::get('/cart-item', [HomeController::class,'cart_item'])->name('cart_item');
