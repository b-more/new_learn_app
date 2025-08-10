<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ActivityTrackingController;
use App\Http\Controllers\ModuleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Use web middleware for Filament authentication and CSRF
Route::middleware(['web'])->group(function () {

    // Core quiz routes
    Route::post('/quiz/start-session', [ModuleController::class, 'startQuizSession']);
    Route::post('/quiz/marking', [ModuleController::class, 'marking']);
    Route::post('/quiz/abandon-session', [ModuleController::class, 'abandonQuizSession']);
    Route::get('/quiz/session-status', [ModuleController::class, 'getSessionStatus']);

    // Existing routes
    Route::post('/module', [ModuleController::class, 'module']);
    Route::post('/quiz', [ModuleController::class, 'quiz']);
    Route::post('/marking', [ModuleController::class, 'marking']);
    Route::post('/mark', [ModuleController::class, 'marking']);
    Route::post('/lesson', [ModuleController::class, 'getLesson']);
    Route::post('/module/lessons', [ModuleController::class, 'getModuleLessons']);

    Route::get('/quiz-history', [ModuleController::class, 'getQuizHistory']);
    Route::post('/track-document-download', [ModuleController::class, 'trackDocumentDownload']);

    // Timer routes
    Route::post('/start-quiz-attempt', [ModuleController::class, 'startQuizAttempt']);
    Route::post('/validate-quiz-timer', [ModuleController::class, 'validateQuizTimer']);
    Route::get('/quiz-timer-status/{attemptId}', [ModuleController::class, 'getQuizTimerStatus']);
});

// Activity tracking routes
Route::prefix('activity')->group(function () {
    Route::post('/track', [ActivityTrackingController::class, 'track']);
    Route::get('/user-activity', [ActivityTrackingController::class, 'getUserActivity']);
    Route::get('/user-progress', [ActivityTrackingController::class, 'getUserProgress']);
    Route::post('/assign-module', [ActivityTrackingController::class, 'assignModule']);
});

// Protected activity routes
Route::middleware(['auth:sanctum'])->prefix('activity')->group(function () {
    Route::get('/my-progress', function (Request $request) {
        $activityService = app(\App\Services\ActivityTrackingService::class);
        return response()->json([
            'success' => true,
            'data' => $activityService->getUserProgressSummary($request->user()->id)
        ]);
    });

    Route::get('/my-activity', function (Request $request) {
        $activityService = app(\App\Services\ActivityTrackingService::class);
        return response()->json([
            'success' => true,
            'data' => $activityService->getUserActivityReport($request->user()->id)
        ]);
    });
});
