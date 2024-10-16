<?php

use App\Http\Controllers\admin\couponController;
use App\Http\Controllers\client\cartController;
use App\Http\Controllers\client\checkoutController;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\getLocationGHNContronller;
use Illuminate\Support\Facades\Route;
use App\Payments\Casso;
use Illuminate\Support\Facades\Cache;

Route::controller(cartController::class)->group(function () {
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

Route::controller(getLocationGHNContronller::class)->group(function () {
      Route::get('/provincer', 'getProvincer')->name('provincer.index');
      Route::get('/district/{id}', 'getDistrict')->name('district.index');
      Route::get('/ward/{id}', 'getWard')->name('ward.index');
});


Route::get('test', [cartController::class, 'viewcarttocart'])->name('cart.no.login');

Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('CheckLogin');

Route::post('progressCheckout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('payment', [Casso::class, 'payment_handler'])->name('payment.index');

Route::get('/redis-test', function () {
      Cache::store('redis')->put('test_key', 'Hello Redis', 10);
      return Cache::store('redis')->get('test_key');
  });
  