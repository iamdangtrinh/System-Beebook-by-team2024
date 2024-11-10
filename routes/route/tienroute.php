<?php

use App\Http\Controllers\client\ManagerUserController;
use App\Http\Controllers\client\LoginGoogleController;
use App\Http\Controllers\client\LoginFaceBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ManagerUserAdmin;
use App\Http\Controllers\client\CheckoutController;

Route::middleware(['CheckAuth'])->group(function () {
    Route::get('/sign-in', [ManagerUserController::class, 'SignIn']);
    Route::post('/sign-in', [ManagerUserController::class, 'HandleSignIn']);
    Route::get('/sign-up', [ManagerUserController::class, 'SignUp']);
    Route::post('/sign-up', [ManagerUserController::class, 'HandleSignUp']);
});

// Login with google
Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
// Login with facebook
Route::get('auth/facebook', [LoginFaceBookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [LoginFaceBookController::class, 'handleFacebookCallback']);
// Logout
Route::get('/logout', [ManagerUserController::class, 'LogOut']);
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
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/dashboard/user', [ManagerUserAdmin::class, 'Index']);
});
