<?php

use App\Http\Controllers\client\ManagerUserController;
use App\Http\Controllers\client\LoginGoogleController;
use App\Http\Controllers\client\LoginFaceBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ManagerUserAdmin;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\admin\CategoryAdmin;


Route::middleware(['CheckAuth'])->group(function () {
    Route::get('/sign-in', [ManagerUserController::class, 'SignIn'])->name('sign-in.index');
    Route::post('/sign-in', [ManagerUserController::class, 'HandleSignIn']);
    Route::get('/sign-up', [ManagerUserController::class, 'SignUp']);
    Route::post('/sign-up', [ManagerUserController::class, 'HandleSignUp']);
});

// Login with google
Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
Route::get('/logout', [ManagerUserController::class, 'LogOut'])->name('logout.index');
// profile
Route::middleware(['CheckLogin'])->group(function () {
    Route::get('/profile', [ManagerUserController::class, 'Profile']);
});
// verify
Route::get('/verify-signup/{id}', [ManagerUserController::class, 'HandleVerifySignUp']);
// reset password 
Route::get('/reset-password', [ManagerUserController::class, 'ResetPassword']);
// redirect form confirm password
Route::get('/confirm-password/{token}', [ManagerUserController::class, 'HandleConfirm']);
// coupon 
Route::post('/apply-coupon', [CheckoutController::class, 'ApplyCoupon'])->name('apply.coupon');
// admin
Route::prefix('admin')->middleware('CheckAdmin')->group(function () {
    Route::get('/user', [ManagerUserAdmin::class, 'Index'])->name('adminUser.index');
    Route::get('/category', [CategoryAdmin::class, 'Index'])->name('adminCategory.index');
});