<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\client\BlogController;


//client

Route::get('/', [ClientController::class, 'home']);
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/blog/{page?}', [BlogController::class, 'indexBlog'])->name('indexBlog');

Route::get('/review/{page?}', [BlogController::class, 'indexReview'])->name('indexReview');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
Route::get('/productshippingmessage', [ClientController::class, 'productshippingmessage']);
Route::get('/shortdescription', [ClientController::class, 'shortdescription']);
Route::get('/posts/{slug}', [BlogController::class, 'show'])->name('posts.show');
//admin

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('overview.index');
    Route::get('/404', [AdminController::class, 'show404']);
    Route::get('/500', [AdminController::class, 'show500']);
    Route::get('/blogs', [AdminController::class, 'blogs']);
    Route::get('/article', [AdminController::class, 'article']);
    Route::get('/dashboard_3', [AdminController::class, 'dashboard_3']);
});

// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
