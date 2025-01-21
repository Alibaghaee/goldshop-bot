<?php


use Illuminate\Support\Facades\Route;


Route::get('set-hook', [\App\Http\Controllers\Bot\TelegramController::class, 'setHook']);


Route::post('first/23124/hook', [\App\Http\Controllers\Bot\TelegramController::class, 'firstHook'])->middleware('verify.telegram.token');
Route::post('second/23124/hook', [\App\Http\Controllers\Bot\TelegramController::class, 'secondHook'])->middleware('verify.telegram.token');
Route::post('third/23124/hook', [\App\Http\Controllers\Bot\TelegramController::class, 'thirdHook'])->middleware('verify.telegram.token');
Route::post('fourth/23124/hook', [\App\Http\Controllers\Bot\TelegramController::class, 'fourthHook'])->middleware('verify.telegram.token');
Route::post('fifth/23124/hook', [\App\Http\Controllers\Bot\TelegramController::class, 'fifthHook'])->middleware('verify.telegram.token');

