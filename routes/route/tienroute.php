<?php 

use App\Http\Controllers\client\ManagerUserController;
use App\Http\Controllers\client\LoginGoogleController;
use App\Http\Controllers\client\LoginFaceBookController;
use Illuminate\Support\Facades\Route;

Route::middleware(['CheckAuth'])->group(function () {
Route::get('/sign-in', [ManagerUserController::class, 'SignIn']);
Route::get('/sign-up', [ManagerUserController::class, 'SignUp']);
});

// Login with google
Route::get('auth/google',[LoginGoogleController::class,'redirectToGoogle']);
Route::get('auth/google/callback',[LoginGoogleController::class,'handleGoogleCallback']);
// Login with facebook
Route::get('auth/facebook',[LoginFaceBookController::class,'redirectToFacebook']);
Route::get('auth/facebook/callback',[LoginFaceBookController::class,'handleFacebookCallback']); 

// Logout
Route::get('/logout', [ManagerUserController::class, 'LogOut']);
