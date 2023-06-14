<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $target = now();
    $source = now()->addYears(3);
    dump($target, $source);
    return $target->isSameDay($source, false);
    return $target->day === $source->day && $target->isSameMonth($source, false);
    return view('welcome');
});
