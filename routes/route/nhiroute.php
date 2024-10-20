<?php 

use App\Http\Controllers\UserController;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\client\CommentController;
use Illuminate\Support\Facades\Route;

Route::post('/submit-review', [CommentController::class, 'add'])->name('comment.add');
Route::get('san-pham/{slug}', [ProductController::class, 'detail'])->name('product.detail');
// Route::post('user', [UserController::class, 'store'])->name('user.store');
// Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
// Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
// Route::get('user', [UserController::class, 'index'])->name('user.index');