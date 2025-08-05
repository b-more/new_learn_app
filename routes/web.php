<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\QuizDetailsController;

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

Route::group(['middleware' => ['auth']], function () {

    // Quiz Details Routes
    Route::get('/quiz-details', [App\Http\Controllers\QuizDetailsController::class, 'showQuizDetails'])
        ->name('quiz.details');

    // Get detailed information for a specific quiz session (AJAX)
    Route::get('/quiz-session/{sessionId}/details', [App\Http\Controllers\QuizDetailsController::class, 'getSessionDetails'])
        ->name('quiz.session-details');

    // Download quiz history
    Route::get('/quiz-history/download', [App\Http\Controllers\QuizDetailsController::class, 'downloadHistory'])
        ->name('quiz.download-history');

    // Download all quiz history for user
    Route::get('/quiz-history/download-all', [App\Http\Controllers\QuizDetailsController::class, 'downloadHistory'])
        ->name('quiz.download-all-history');
});

// If you're using API routes (routes/api.php), you can also add these:
Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'api'], function () {

    // API endpoint for quiz session details
    Route::get('/quiz-session/{sessionId}/details', [App\Http\Controllers\QuizDetailsController::class, 'getSessionDetails']);

    // API endpoint for downloading quiz history
    Route::post('/quiz-history/download', [App\Http\Controllers\QuizDetailsController::class, 'downloadHistory']);
});
