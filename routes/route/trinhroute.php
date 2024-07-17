<?php 

use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'index'])->name('user.index');
Route::post('user', [UserController::class, 'store'])->name('user.store');
Route::get('user/{id}', [UserController::class, 'edit'])->name('user.show');
Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');