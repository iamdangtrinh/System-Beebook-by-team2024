<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\ClientController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\client\BlogController;
use App\Http\Controllers\admin\BlogController as AdminBlogController;
use App\Http\Controllers\admin\BlogAdmin;
use App\Http\Controllers\admin\couponAdmin;
use App\Http\Controllers\admin\TaxonomyAdmin;
//client

Route::get('/', [ClientController::class, 'home']);
Route::get('/contact', [ClientController::class, 'contact'])->name('contact');
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/blog/{page?}', [BlogController::class, 'indexBlog'])->name('indexBlog');

Route::get('/review/{page?}', [BlogController::class, 'indexReview'])->name('indexReview');
Route::get('/productshippingmessage', [ClientController::class, 'productshippingmessage']);
Route::get('/shortdescription', [ClientController::class, 'shortdescription']);
Route::get('/posts/{slug}', [BlogController::class, 'show'])->name('posts.show');
//admin

Route::prefix('admin')->middleware('CheckAdmin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('overview.index');
    // Route::get('/blogs', [AdminController::class, 'blogs']);
    Route::get('/blog/{id}', [BlogAdmin::class, 'edit'])->name('adminblog.edit');
    Route::post('/blog/update/', [BlogAdmin::class, 'update'])->name('adminblog.update');

    Route::get('/article', [AdminController::class, 'article']);
    Route::get('/blog', [BlogAdmin::class, 'index'])->name('adminblog.index');
    Route::get('/taxonomy', [TaxonomyAdmin::class, 'index'])->name('admintaxonomy.index');
    Route::get('/coupon', [couponAdmin::class, 'index'])->name('admincoupon.index');
});

// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
