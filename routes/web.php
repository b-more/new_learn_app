<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\FileUploadController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/random-quote', [App\Http\Controllers\QuoteController::class,'randomQuote']);

Route::get('/quiz/attempts/download/{userId}', [App\Http\Controllers\QuizAttemptController::class, 'downloadPDF'])
    ->name('quiz.attempts.download')
    ->middleware('auth');

Route::get('/debug/upload-config', [FileUploadController::class, 'checkConfig'])
    ->middleware('auth')
    ->name('debug.upload-config');

Route::post('/upload/file', [FileUploadController::class, 'upload'])
    ->middleware('auth')
    ->name('upload.file');

