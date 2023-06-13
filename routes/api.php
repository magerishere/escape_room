<?php

use App\Http\Controllers\Api\V1\EscapeRoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->as('v1.')->group(function () {
    Route::apiResource('escape-rooms', EscapeRoomController::class)->only(['index', 'show']);
    Route::get('escape-rooms/{escape_room}/time-slots', [EscapeRoomController::class, 'showTimes']);
});
