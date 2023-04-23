<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\CartStorageNewController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class,'index'])->name('home');

//product
Route::get('/product/{slug}', [ProductController::class,'productByCategory'])->name('productByCategory');
Route::get('/product/{slug}', [ProductController::class,'productBySubCategory'])->name('productBySubCategory');
Route::get('/productByBrand/{slug}/', [ProductController::class,'productByBrand'])->name('productByBrand');
Route::get('/productByBrand/{slug}/{brand}', [ProductController::class,'productByBrand'])->name('productByBrand');
Route::get('/productByBrand/{slug}/{brand}/{order}', [ProductController::class,'productByBrand'])->name('productByBrand');


Route::get('/product-detail/{slug}', [ProductController::class,'productDetail'])->name('product_detail');

//cart
Route::group(['middleware' => ['auth']], function(){
    
    Route::post('/add-to-cart', [CartStorageNewController::class,'AddToCart'])->name('AddToCart');
    Route::get('/cart-list', [CartStorageNewController::class,'cart_list'])->name('cart_list');
    
    Route::post('/remove-from-cart', [CartStorageNewController::class,'RemoveFromCart'])->name('RemoveFromCart');
    Route::post('/update-cart', [CartStorageNewController::class,'updateCart'])->name('updateCart');

    Route::get('/checkout/{uuid}', [CheckoutController::class,'index'])->name('checkout');
    Route::post('/pay', [CheckoutController::class,'pay'])->name('pay');
    Route::post('/razor-pay-action', [CheckoutController::class,'razorPayAction'])->name('razorpay');
    Route::post('/verify-payment', [CheckoutController::class,'veryfyRazorpayAction'])->name('verify-payment');
    Route::get('/thankyou', [CheckoutController::class,'thankyou'])->name('thankyou');

    Route::match(['get', 'post'], '/order', [OrderController::class,'store'])->name('order');

    Route::get('/address', [AddressController::class,'index'])->name('address');
    Route::post('/address/store', [AddressController::class,'store'])->name('store');
    Route::get('/address/make-default/{uuid}', [AddressController::class,'makeDefault'])->name('makeDefault');
    Route::post('/address/update', [AddressController::class,'update'])->name('update');
    Route::get('/address/remove/{id}', [AddressController::class,'remove'])->name('address-remove');

    Route::post('/apply-coupon', [CartStorageNewController::class,'applyCoupon'])->name('applyCoupon');
    Route::post('/remove-coupon', [CartStorageNewController::class,'removeCoupon'])->name('removeCoupon');
    
    Route::get('/profile', [ProfileController::class,'index'])->name('user-profile');
    Route::post('/profile-update/{id}', [ProfileController::class,'update'])->name('profile-update');
    



});
//signup form
Route::get('/signup', [HomeController::class,'signup'])->name('signup');

// static pages

Route::get('/page/{slug}', [PageController::class,'show'])->name('front.pages');
Route::get('/disclaimer', [PageController::class,'disclaimer'])->name('front.disclaimer');

