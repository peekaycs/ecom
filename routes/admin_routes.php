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
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\OrderController;

Route::get('/admin', function(){
    return view('admin.login');
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
    Route::delete('/attribute-groups/delete/{id}', [AttributeGroupController::class,'delete'])->name('delete-attribute-group');
    // attributes
    Route::get('/attributes', [AttributeController::class,'index'])->name('attributes');
    Route::get('/attributes/create', [AttributeController::class,'create'])->name('create-attribute');
    Route::post('/attributes/store', [AttributeController::class,'store'])->name('store-attribute');
    Route::get('/attributes/edit/{id}', [AttributeController::class,'edit'])->name('edit-attribute');
    Route::put('/attributes/update/{id}', [AttributeController::class,'update'])->name('update-attribute');
    Route::delete('/attribute/delete/{id}', [AttributeController::class,'delete'])->name('delete-attribute');
    // category 
    Route::get('/categories', [CategoryController::class,'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('create-category');
    Route::post('/categories/store', [CategoryController::class,'store'])->name('store-category');
    Route::get('/categories/edit/{id}', [CategoryController::class,'edit'])->name('edit-category');
    Route::put('/categories/update/{id}', [CategoryController::class,'update'])->name('update-category');
    Route::delete('/categories/delete/{id}', [CategoryController::class,'delete'])->name('delete-category');
    // subcategory
    Route::get('/subcategories', [SubCategoryController::class,'index'])->name('subcategories');
    Route::get('/subcategories/create', [SubCategoryController::class,'create'])->name('create-subcategory');
    Route::post('/subcategories/store', [SubCategoryController::class,'store'])->name('store-subcategory');
    Route::get('/subcategories/edit/{id}', [SubCategoryController::class,'edit'])->name('edit-subcategory');
    Route::put('/subcategories/update/{id}', [SubCategoryController::class,'update'])->name('update-subcategory');
    Route::get('/subcategory/get-options/{id}', [SubCategoryController::class,'getSubcategoryOption'])->name('get-subcategory-option');
    Route::delete('/subcategory/delete/{id}', [SubCategoryController::class,'delete'])->name('delete-subcategory');
    // Product
    Route::get('/products', [ProductController::class,'index'])->name('products');
    Route::get('/products/create', [ProductController::class,'create'])->name('create-product');
    Route::post('/products/store', [ProductController::class,'store'])->name('store-product');
    Route::get('/products/edit/{id}', [ProductController::class,'edit'])->name('edit-product');
    Route::put('/products/update/{id}', [ProductController::class,'update'])->name('update-product');
    Route::delete('/products/delete/{id}', [ProductController::class,'delete'])->name('delete-product');


    Route::post('/bulkUpload', [ProductController::class,'bulkUpload'])->name('bulkUpload');


    // Brnads 

    Route::get('/brands',[BrandController::class,'index'])->name('brands');
    Route::get('/brands/create',[BrandController::class,'create'])->name('create-brand');
    Route::post('/brands/store',[BrandController::class,'store'])->name('store-brand');
    Route::get('/brands/edit/{id}',[BrandController::class,'edit'])->name('edit-brand');
    Route::put('/brands/update/{id}',[BrandController::class,'update'])->name('update-brand');
    Route::delete('/brand/delete/{id}', [BrandController::class,'delete'])->name('delete-brand');

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
    Route::delete('/admin-user/delete/{id}',[AdminUserController::class,'delete'])->name('delete-admin-user');

    // Banner routes
    Route::get('/banners',[BannerController::class,'index'])->name('banners');
    Route::get('banner/create',[BannerController::class,'create'])->name('create-banner');
    Route::post('banner/store',[BannerController::class,'store'])->name('store-banner');
    Route::put('banner/update/{id}',[BannerController::class,'update'])->name('update-banner');
    Route::get('banner/edit/{id}',[BannerController::class,'edit'])->name('edit-banner');
    Route::delete('/banner/delete/{id}', [BannerController::class,'delete'])->name('delete-banner');
    Route::get('get-banner-image-form',[BannerController::class,'getBannerImageForm'])->name('get-banner-image-form');

    // Coupons
    Route::get('coupons',[CouponController::class,'index'])->name('coupons');
    Route::get('coupon/create',[CouponController::class,'create'])->name('create-coupon');
    Route::post('coupon/store',[CouponController::class,'store'])->name('store-coupon');
    Route::get('coupon/edit/{id}',[CouponController::class,'edit'])->name('edit-coupon');
    Route::put('coupon/update/{id}',[CouponController::class,'update'])->name('update-coupon');
    Route::delete('/coupon/delete/{id}', [CouponController::class,'delete'])->name('delete-coupon');
    // Pages
    Route::get('pages',[PageController::class,'index'])->name('pages');
    Route::get('page/create',[PageController::class,'create'])->name('create-page');
    Route::post('page/store',[PageController::class,'store'])->name('store-page');
    Route::get('page/edit/{id}',[PageController::class,'edit'])->name('edit-page');
    Route::put('page/update/{id}',[PageController::class,'update'])->name('update-page');
    Route::delete('/page/delete/{id}', [PageController::class,'delete'])->name('delete-page');

    // Vendors
     Route::get('/vendors',[VendorController::class,'index'])->name('vendors');
     Route::get('vendor/create',[VendorController::class,'create'])->name('create-vendor-user');
     Route::post('vendor/store',[VendorController::class,'store'])->name('store-vendor-user');
     Route::put('vendor/update/{id}',[VendorController::class,'update'])->name('update-vendor-user');
     Route::get('/vendor/edit/{id}',[VendorController::class,'edit'])->name('edit-vendor-user');
     Route::delete('/vendor/delete/{id}', [VendorController::class,'delete'])->name('delete-vendor');
     // Order

     Route::get('/orders',[OrderController::class,'listOrders'])->name('orders');
     Route::get('/order-detail/{id}',[OrderController::class,'orderDetail'])->name('order-detail');
     Route::get('/order/update/{id}',[OrderController::class,'updateOrder'])->name('order-update');
});