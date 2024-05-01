<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::get('test1', [\App\Http\Controllers\Bot\TestController::class, 'test1']);
Route::get('test2', [\App\Http\Controllers\Bot\TestController::class, 'test2']);
