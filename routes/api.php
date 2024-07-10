<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');






//Route::get('test1', [\App\Http\Controllers\Bot\TestController::class, 'test1']);
//Route::get('test2', [\App\Http\Controllers\Bot\TestController::class, 'test2']);
Route::get('set-hook', [\App\Http\Controllers\Bot\TestController::class, 'setHook']);
Route::post('h/23124/hook', [\App\Http\Controllers\Bot\TestController::class, 'hook'])->middleware('verify.telegram.token');
//Route::get('testTala', [\App\Http\Controllers\Bot\TestController::class, 'testTala']);
