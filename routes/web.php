<?php

use Illuminate\Support\Facades\Route;



//FrontEndSection

Route::get('/', [\App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('home.frontend');

//ProductCategory
Route::get('/product/category/{slug}', [\App\Http\Controllers\Frontend\IndexController::class, 'productCategory'])->name('product.category');
//EndProductCategory

//ProductDetails
Route::get('/product-detail/{slug}', [\App\Http\Controllers\Frontend\IndexController::class, 'productDetails'])->name('product.details');
//EndProductDetails


//EndFrontEndSection



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin
Route::group(['prefix'=>'admin','middleware'=>'auth'],function (){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'admin'])->name('admin');

    //Banner Section
    Route::resource('banner',\App\Http\Controllers\BannerController::class);
    Route::post('banner_status',[\App\Http\Controllers\BannerController::class,'bannerStatus'])->name('banner.status');

    //Category Section
    Route::resource('category',\App\Http\Controllers\CategoryController::class);
    Route::post('category_status',[\App\Http\Controllers\CategoryController::class,'categoryStatus'])->name('category.status');
    Route::post('category_isparent',[\App\Http\Controllers\CategoryController::class,'categoryIsParent'])->name('category_isparent');
    Route::post('category/{id}/child',[\App\Http\Controllers\CategoryController::class,'getChildByParentID']);


    //Brand Section
    Route::resource('brand',\App\Http\Controllers\BrandController::class);
    Route::post('brand_status',[\App\Http\Controllers\BrandController::class,'brandStatus'])->name('brand.status');

    //Product Section
    Route::resource('product',\App\Http\Controllers\ProductController::class);
    Route::post('product_status',[\App\Http\Controllers\ProductController::class,'productStatus'])->name('product.status');

    //Users Section
    Route::resource('user',\App\Http\Controllers\UsersController::class);
    Route::post('user_status',[\App\Http\Controllers\UsersController::class,'userStatus'])->name('user.status');

});
