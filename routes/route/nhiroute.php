<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\client\WishlistController;
use App\Http\Controllers\client\SearchController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\CommentController as AdminCommentController;
use Illuminate\Support\Facades\Route;

Route::get('san-pham/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('cua-hang', [ProductController::class, 'index'])->name('product.index');
Route::get('san-pham-noi-bat', [ProductController::class, 'hot'])->name('product.hot');
Route::get('/danh-muc/{slug}', [ProductController::class, 'category'])->name('product.category');
Route::get('/tac-gia/{slug}', [ProductController::class, 'author'])->name('product.author');
Route::get('/nha-xuat-ban/{slug}', [ProductController::class, 'manufacturer'])->name('product.manufacturer');
Route::get('/filter-products', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/yeu-thich', [WishlistController::class, 'getWishlist'])->name('wishlist.index');
// Route cho trang kết quả tìm kiếm
Route::get('/search', [SearchController::class, 'index'])->name('search');
// Route cho tìm kiếm AJAX
Route::get('/search/ajax', [SearchController::class, 'ajaxSearch'])->name('search.ajax');



Route::middleware('auth')->group(function () {
    Route::post('/wishlist/toggle/{idproduct}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

Route::prefix('admin')->middleware('CheckAdmin')->group(function () {
    Route::get('/product', [AdminProductController::class, 'index'])->name('adminproduct.index');
    Route::get('/product/add', [AdminProductController::class, 'add'])->name('adminproduct.add');
    Route::post('/product/store', [AdminProductController::class, 'store'])->name('product.store');
    Route::delete('/product/destroy/{id}', [AdminProductController::class, 'destroy'])->name('adminproduct.destroy');
    Route::delete('/product/{id}/force-delete', [AdminProductController::class, 'forceDelete'])->name('adminproduct.forceDelete');
    Route::delete('/product/force-delete-all', [AdminProductController::class, 'forceDeleteAll'])->name('adminproduct.forceDeleteAll');
    Route::post('/product/{id}/restore', [AdminProductController::class, 'restore'])->name('adminproduct.restore');
    Route::post('/product/restore-all', [AdminProductController::class, 'restoreAll'])->name('adminproduct.restoreAll');
    Route::get('product/{id}/edit', [AdminProductController::class, 'edit'])->name('adminproduct.edit');
    Route::put('product/{id}', [AdminProductController::class, 'update'])->name('adminproduct.update');
    Route::post('product/update-hot', [AdminProductController::class, 'updateHot'])->name('adminproduct.update-hot');
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('admincomment.index');
    Route::get('/comments/{product}', [AdminCommentController::class, 'show'])->name('admincomment.show');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admincomment.destroy');
});
