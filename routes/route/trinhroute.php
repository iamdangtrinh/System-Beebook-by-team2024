<?php 

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\client\cartController;
use Illuminate\Support\Facades\Route;

Route::get('/cart', [cartController::class, 'index'])->name('cart');
