<?php 

use App\Http\Controllers\client\ManagerUserController;
use Illuminate\Support\Facades\Route;

Route::get('/sign-in', [ManagerUserController::class, 'SignIn']);
Route::post('/sign-in', [ManagerUserController::class, 'handleSignIn']);

// Route::post('user', [UserController::class, 'store'])->name('user.store');
// Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
// Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
// Route::get('user', [UserController::class, 'index'])->name('user.index');