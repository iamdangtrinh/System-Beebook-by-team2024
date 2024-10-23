<?php 

use App\Http\Controllers\UserController;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\client\CommentController;
use Illuminate\Support\Facades\Route;

// Route::post('/submit-review', [CommentController::class, 'add'])->name('comment.add');
Route::get('san-pham/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('cua-hang', [ProductController::class, 'index'])->name('product.index');
Route::get('/danh-muc/{slug}', [ProductController::class, 'category'])->name('product.category');
Route::get('/tac-gia/{slug}', [ProductController::class, 'author'])->name('product.author');
Route::get('/nha-xuat-ban/{slug}', [ProductController::class, 'manufacturer'])->name('product.manufacturer');
// Route::post('user', [UserController::class, 'store'])->name('user.store');
// Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
// Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
// Route::get('user', [UserController::class, 'index'])->name('user.index');