<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AttributeGroupController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AdminUserController;

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

    // Brnads 

    Route::get('/brands',[BrandController::class,'index'])->name('brands');
    Route::get('/brands/create',[BrandController::class,'create'])->name('create-brand');
    Route::post('/brands/store',[BrandController::class,'store'])->name('store-brand');
    Route::get('/brands/edit/{id}',[BrandController::class,'edit'])->name('edit-brand');
    Route::put('/brands/update/{id}',[BrandController::class,'update'])->name('update-brand');

    // auxiliary routes
    Route::get('/attributes/form',[AttributeController::class,'form'])->name('get-attribute-form');
    Route::get('/attributes/options/{id}',[AttributeController::class,'options'])->name('get-attribute-options');
    // Roles routes

    Route::get('/roles',[RoleController::class,'index'])->name('roles');
    Route::get('role/create',[RoleController::class,'create'])->name('create-role');
    Route::post('role/store',[RoleController::class,'store'])->name('store-role');
    Route::put('role/update/{id}',[RoleController::class,'update'])->name('update-role');
    Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('edit-role');
    // Permissions routes
    Route::get('/permissions',[PermissionController::class,'index'])->name('permissions');
    Route::get('permission/create',[PermissionController::class,'create'])->name('create-permission');
    Route::post('permission/store',[PermissionController::class,'store'])->name('store-permission');
    Route::put('permission/update/{id}',[PermissionController::class,'update'])->name('update-permission');
    Route::get('/permission/edit/{id}',[PermissionController::class,'edit'])->name('edit-permission');
    // Admin user's routes
    Route::get('/admin-users',[AdminUserController::class,'index'])->name('admin-users');
    Route::get('admin-user/create',[AdminUserController::class,'create'])->name('create-admin-user');
    Route::post('admin-user/store',[AdminUserController::class,'store'])->name('store-admin-user');
    Route::put('admin-user/update/{id}',[AdminUserController::class,'update'])->name('update-admin-user');
    Route::get('/admin-user/edit/{id}',[AdminUserController::class,'edit'])->name('edit-admin-user');
});