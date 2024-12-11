<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\couponController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\client\cartController;
use App\Http\Controllers\client\checkoutController;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\client\getLocationGHNContronller;
use App\Http\Controllers\client\ManagerUserController;
use App\Http\Controllers\client\OrderController as ClientOrderController;
use App\Http\Controllers\client\SepayController;
use Illuminate\Support\Facades\Route;
use App\Payments\Casso;
use Illuminate\Support\Facades\Cache;

Route::controller(cartController::class)->group(function () {
      Route::get('/cart', 'index')->name('cart.index');
      Route::post('/cart/update', 'update')->name('cart.update');
      Route::post('/cart/addtocart', 'store')->name('cart.store');
      Route::post('/cart/delete', 'delete')->name('cart.delete');
});

Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('CheckLogin');
Route::post('progressCheckout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('CheckLogin');
Route::get('thank-you/{id}', [CheckoutController::class, 'thankyou'])->name('thankyou.index')->middleware('CheckLogin');
// Route::get('payment', [Casso::class, 'payment_handler'])->name('payment.index')->middleware('CheckLogin');

// client
Route::get('/order/{id}', [CheckoutController::class, 'show'])->name('order.show')->middleware('CheckLogin');
Route::post('/order/update', [ClientOrderController::class, 'update'])->name('order.update')->middleware('CheckLogin');
Route::post('/order-check-status', [CheckoutController::class, 'checkStatus'])->name('order.checkStatus');

Route::prefix('profile/your-order')->middleware('CheckLogin:Vui lòng đăng nhập để thực hiện chức năng!')->name('your-order.')->group(function () {
      Route::get('/', [ManagerUserController::class, 'yourOrder'])->name('index');
      Route::get('/{id}', [ManagerUserController::class, 'yourOrderDetail'])->name('detail-index');
      Route::get('/cancel/{id}', [ClientOrderController::class, 'cancel'])->name('update.cancel');
});

Route::get('/redis-test', function () {
      // Cache::store('redis')->put('test_key', 'Hello Redis', 10);
      Cache::store('redis')->get('order_year_data');
      return Cache::store('redis')->get('test_key');
});

// admin
Route::prefix('admin')->middleware('CheckAdmin')->group(function () {
      Route::get('/order', [OrderController::class, 'index'])->name('order.index');
      Route::get('/order/{id}', [OrderController::class, 'edit'])->name('admin.order.detail');
      Route::post('/order/update', [OrderController::class, 'store'])->name('admin.order.store');

      Route::get('/banner', [BannerController::class, 'index'])->name('admin.banner.index');
      Route::post('/banner', [BannerController::class, 'store'])->name('admin.banner.store');
      Route::post('/banner/update/', [BannerController::class, 'update'])->name('admin.banner.update');
      Route::post('/banner/update/status', [BannerController::class, 'updateStatus'])->name('admin.banner.update.status');

      Route::get('/destroy/banner/{id}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');
      Route::get('/banner/edit/{id}', [BannerController::class, 'show'])->name('admin.banner.detail');
      
      Route::get('/transaction/all', [SepayController::class, 'show'])->name('transaction.history');
      
      Route::get('/settings', [BannerController::class, 'show'])->name('admin.banner.detail');

});
