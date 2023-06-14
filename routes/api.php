<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\EscapeRoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes Version 1
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->as('v1.')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | No middleware
    |--------------------------------------------------------------------------
    */
    Route::apiResource('escape-rooms', EscapeRoomController::class)->only(['index', 'show']);
    Route::get('escape-rooms/{escape_room}/time-slots', [EscapeRoomController::class, 'showTimes'])->name('escape-rooms.showTimes');

    /*
    |--------------------------------------------------------------------------
    | Guest middleware
    |--------------------------------------------------------------------------
    */
    Route::middleware('guest')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    });

    /*
    |--------------------------------------------------------------------------
    | Auth middleware
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::apiResource('bookings', BookingController::class);
    });


});
