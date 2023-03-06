<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AttributeGroupController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/admin', function(){
    return view('auth.login');
});
Route::group(['prefix'=>'admin','middleware' => ['auth','isAdmin']], function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin-dashboard');
    // admin 
    Route::get('/profile', [ProfileController::class,'index'])->name('admin-profile');
    Route::get('/profile/edit', [ProfileController::class,'edit'])->name('admin-profile-edit');
    Route::put('/profile/store/{id}', [ProfileController::class,'update'])->name('admin-profile-store');
    
    // attributes group
    Route::get('/attribute-groups/', [AttributeGroupController::class,'index'])->name('attribute-groups');
    Route::get('/attribute-groups/create', [AttributeGroupController::class,'create'])->name('create-attribute-group');
    Route::post('/attribute-groups/store', [AttributeGroupController::class,'store'])->name('store-attribute-group');
    Route::get('/attribute-groups/edit/{id}', [AttributeGroupController::class,'edit'])->name('edit-attribute-group');
    Route::put('/attribute-groups/update/{id}', [AttributeGroupController::class,'update'])->name('update-attribute-group');
    // attributes
    Route::get('/attributes', [AttributeController::class,'index'])->name('attributes');
    Route::get('/attributes/create', [AttributeController::class,'create'])->name('create-attribute');
    Route::post('/attributes/store', [AttributeController::class,'store'])->name('store-attribute');
    Route::get('/attributes/edit/{id}', [AttributeController::class,'edit'])->name('edit-attribute');
    Route::put('/attributes/update/{id}', [AttributeController::class,'update'])->name('update-attribute');
    // category 
    Route::get('/categories', [CategoryController::class,'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('create-category');
    Route::post('/categories/store', [CategoryController::class,'store'])->name('store-category');
    Route::get('/categories/edit/{id}', [CategoryController::class,'edit'])->name('edit-category');
    Route::put('/categories/update/{id}', [CategoryController::class,'update'])->name('update-category');
    // subcategory
    Route::get('/subcategories', [SubCategoryController::class,'index'])->name('subcategories');
    Route::get('/subcategories/create', [SubCategoryController::class,'create'])->name('create-subcategory');
    Route::post('/subcategories/store', [SubCategoryController::class,'store'])->name('store-subcategory');
    Route::get('/subcategories/edit/{id}', [SubCategoryController::class,'edit'])->name('edit-subcategory');
    Route::put('/subcategories/update/{id}', [SubCategoryController::class,'update'])->name('update-subcategory');
    // Product
    Route::get('/products', [ProductController::class,'index'])->name('products');
    Route::get('/products/create', [ProductController::class,'create'])->name('create-product');
    Route::post('/products/store', [ProductController::class,'store'])->name('store-product');
    Route::get('/products/edit/{id}', [ProductController::class,'edit'])->name('edit-product');
    Route::put('/products/update/{id}', [ProductController::class,'update'])->name('update-product');

    // auxiliary routes
    Route::get('/attributes/form',[AttributeController::class,'form'])->name('get-attribute-form');
    Route::get('/attributes/options/{id}',[AttributeController::class,'options'])->name('get-attribute-options');
});