<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/module/lessons',[App\Http\Controllers\ModuleController::class,'module']);
Route::post('/quiz',[App\Http\Controllers\ModuleController::class,'quiz']);
Route::post('/mark',[App\Http\Controllers\ModuleController::class,'marking']);
