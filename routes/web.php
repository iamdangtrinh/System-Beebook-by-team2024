<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ClientController::class, 'home']);
Route::get('/cart', [ClientController::class, 'cart']);
Route::get('/shop', [ClientController::class, 'shop']);
Route::get('/blog', [ClientController::class, 'blog']);
include_once('route/trinhroute.php'); 
include_once('route/phatroute.php');
include_once('route/nhiroute.php');
include_once('route/tienroute.php');