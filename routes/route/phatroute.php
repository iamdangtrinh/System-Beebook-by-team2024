<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\admin\AdminController;



//client

Route::get('/', [ClientController::class, 'home']);
Route::get('/cart', [ClientController::class, 'cart']);
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/blog', [ClientController::class, 'blog']);
Route::get('/blogarticle', [ClientController::class, 'blogarticle']);
Route::get('/bloggridview', [ClientController::class, 'bloggridview']);
Route::get('/productshippingmessage', [ClientController::class, 'productshippingmessage']);
Route::get('/shortdescription', [ClientController::class, 'shortdescription']);
//admin

Route::prefix('admin')->group(function () {
    Route::get('/404', [AdminController::class, 'show404']);
    Route::get('/500', [AdminController::class, 'show500']);
    Route::get('/blogs', [AdminController::class, 'blogs']);
    Route::get('/dashboard_3', [AdminController::class, 'dashboard_3']);
});

// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
