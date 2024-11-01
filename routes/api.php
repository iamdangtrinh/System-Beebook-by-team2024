<?php

use App\Http\Controllers\client\SepayController as ClientSepayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SePay\SePay\Http\Controllers\SePayController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'sepay',
    'as' => 'sepay.',
    'middleware' => ['api'],
], function () {
    Route::any('/webhook', [ClientSepayController::class, 'webhook'])->name('webhook');
});