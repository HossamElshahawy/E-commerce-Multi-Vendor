<?php

use Illuminate\Support\Facades\Route;


//AuthFrontEnd
Route::get('user/auth', [\App\Http\Controllers\Frontend\AuthController::class, 'userAuth'])->name('user.auth');
Route::post('user/login',[\App\Http\Controllers\Frontend\AuthController::class,'userLogin'])->name('user.login');
Route::post('user/register',[\App\Http\Controllers\Frontend\AuthController::class,'userRegister'])->name('user.register');
Route::post('user/logout',[\App\Http\Controllers\Frontend\AuthController::class,'userLogout'])->name('user.logout');

//EndAuthFrontEnd

//FrontEndSection

Route::get('/', [\App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('home.frontend');

//ProductCategory
Route::get('/product/category/{slug}', [\App\Http\Controllers\Frontend\IndexController::class, 'productCategory'])->name('product.category');
//EndProductCategory

//ProductDetails
Route::get('/product-detail/{slug}', [\App\Http\Controllers\Frontend\IndexController::class, 'productDetails'])->name('product.details');
//EndProductDetails


//CartSection
Route::get('/cart', [\App\Http\Controllers\Frontend\CartController::class, 'cart'])->name('cart');

Route::post('/cart/store', [\App\Http\Controllers\Frontend\CartController::class, 'cartStore'])->name('cart.store');
Route::post('/cart/delete', [\App\Http\Controllers\Frontend\CartController::class, 'cartDelete'])->name('cart.delete');


//EndCartSection


//EndFrontEndSection



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function (){
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

    //Coupon Section
    Route::resource('coupon',\App\Http\Controllers\CouponController::class);
    Route::post('coupon_status',[\App\Http\Controllers\CouponController::class,'couponStatus'])->name('coupon.status');

});

//Seller
Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],function (){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'admin'])->name('seller');
});


//user
Route::group(['prefix'=>'user'],function (){
    Route::get('/dashboard',[\App\Http\Controllers\Frontend\DashboardController::class,'index'])->name('user.dashboard');
    Route::get('/order',[\App\Http\Controllers\Frontend\DashboardController::class,'userOrder'])->name('user.order');
    Route::get('/address',[\App\Http\Controllers\Frontend\DashboardController::class,'userAddress'])->name('user.address');
    Route::get('/account/details',[\App\Http\Controllers\Frontend\DashboardController::class,'userAccount'])->name('user.account');

    Route::post('/billing/address/{id}',[\App\Http\Controllers\Frontend\DashboardController::class,'billingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}',[\App\Http\Controllers\Frontend\DashboardController::class,'shippingAddress'])->name('shipping.address');

    Route::post('/update/account/{id}',[\App\Http\Controllers\Frontend\DashboardController::class,'updateAccount'])->name('update.account');


});
