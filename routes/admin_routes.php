<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AttributeGroupController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/admin', function(){
    return view('auth.login');
});
Route::group(['prefix'=>'admin','middleware' => ['auth','isAdmin']], function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin-dashboard');
    Route::get('/profile', [ProfileController::class,'index'])->name('admin-profile');
    Route::get('/attribute-groups/', [AttributeGroupController::class,'index'])->name('attribute-groups');
    Route::get('/attribute-groups/create', [AttributeGroupController::class,'create'])->name('create-attribute-group');
    Route::post('/attribute-groups/store', [AttributeGroupController::class,'store'])->name('store-attribute-group');
    Route::get('/attributes', [AttributeController::class,'index'])->name('attributes');
    Route::get('/attributes/create', [AttributeController::class,'create'])->name('create-attribute');
    Route::post('/attributes/store', [AttributeController::class,'store'])->name('store-attribute');
    Route::get('/categories', [CategoryController::class,'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('create-category');
    Route::post('/categories/store', [CategoryController::class,'store'])->name('store-category');
    Route::get('/categories/show/{id}', [CategoryController::class,'show'])->name('show-category');
    
});