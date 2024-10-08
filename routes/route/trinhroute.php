<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\client\cartController;
use Illuminate\Support\Facades\Route;

Route::controller(CartController::class)->group(function () {
      Route::get('/cart', 'index')->name('cart.index');
      Route::post('/cart/update', 'update')->name('cart.update');
      Route::post('/cart/addtocart', 'store')->name('cart.store');
      Route::post('/cart/delete', 'delete')->name('cart.delete');
});

Route::get('test', [cartController::class, 'viewcarttocart'])->name('cart.no.login');
