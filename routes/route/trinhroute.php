<?php

use App\Http\Controllers\admin\couponController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\client\cartController;
use App\Http\Controllers\client\ClientController;
use Illuminate\Support\Facades\Route;

Route::controller(CartController::class)->group(function () {
      Route::get('/cart', 'index')->name('cart.index');
      Route::post('/cart/update', 'update')->name('cart.update');
      Route::post('/cart/addtocart', 'store')->name('cart.store');
      Route::post('/cart/delete', 'delete')->name('cart.delete');
});


// Route::controller(couponController::class)->group(function () {
//       Route::get('/coupon', 'index')->name('coupon.index');
//       Route::post('/coupon/update', 'update')->name('coupon.update');
//       Route::post('/coupon/addtocoupon', 'store')->name('coupon.store');
//       Route::post('/coupon/delete', 'delete')->name('coupon.delete');
// });



Route::get('checkout', [ClientController::class, 'checkOut'])->name('checkout.payment');
