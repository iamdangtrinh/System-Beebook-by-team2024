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
Route::get('/posts/{slug}', [BlogController::class, 'show'])->name('posts.show');
//admin

Route::prefix('admin')->middleware('CheckAdmin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('overview.index');
    // Route::get('/blogs', [AdminController::class, 'blogs']);
    Route::get('/blog', [BlogAdmin::class, 'index'])->name('adminblog.index');
    Route::get('/blog/edit/{id}', [BlogAdmin::class, 'edit'])->name('adminblog.edit');
    Route::post('/blog/update/', [BlogAdmin::class, 'update'])->name('adminblog.update');
    Route::get('/blog/add', [BlogAdmin::class, 'showAdd'])->name('adminblog.show');
    Route::post('/blog/addnew', [BlogAdmin::class, 'add'])->name('adminblog.add');

    // bản tin xóa mềm
    Route::get('/blog/restore/{id}', [BlogAdmin::class, 'restore'])->name('adminblog.restore');
    Route::get('/blog/forceDelete/{id}', [BlogAdmin::class, 'forceDelete'])->name('adminblog.forceDelete');
    Route::get('/blog/trash', [BlogAdmin::class, 'trash'])->name('adminblog.trash');

    Route::get('/article', [AdminController::class, 'article']);
    Route::get('/taxonomy/author', [TaxonomyAdmin::class, 'author'])->name('admintaxonomy.author');
    Route::get('/taxonomy/translator', [TaxonomyAdmin::class, 'translator'])->name('admintaxonomy.translator');
    Route::get('/taxonomy/manufacturer', [TaxonomyAdmin::class, 'manufacturer'])->name('admintaxonomy.manufacturer');
    Route::get('/taxonomy/forceDelete/{id}', [TaxonomyAdmin::class, 'forceDelete'])->name('admintaxonomy.forceDelete');
    Route::get('/taxonomy/edit/{id}', [TaxonomyAdmin::class, 'edit'])->name('admintaxonomy.edit');
    Route::post('/taxonomy/update/{id}', [TaxonomyAdmin::class, 'update'])->name('admintaxonomy.update');
    Route::post('/taxonomy/add', [TaxonomyAdmin::class, 'add'])->name('admintaxonomy.add');

    Route::get('/coupon', [couponAdmin::class, 'index'])->name('admincoupon.index');
});

// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
// Route::get('/activity_stream', [AdminController::class, 'activity_stream']);
