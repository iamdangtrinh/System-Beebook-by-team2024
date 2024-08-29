<?php 

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\client\cartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', [cartController::class, 'index'])->name('cart');
Route::post('/cart/update', [cartController::class, 'update'])->name('cart.update');
