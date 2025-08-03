<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ActivityTrackingController;
use App\Http\Controllers\ModuleController;

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

// Existing Module Controller routes
Route::post('/module', [ModuleController::class, 'module']);
Route::post('/quiz', [ModuleController::class, 'quiz']);
Route::post('/marking', [ModuleController::class, 'marking']);
Route::post('/mark', [ModuleController::class, 'marking']);
Route::post('/lesson', [ModuleController::class, 'getLesson']);
Route::get('/quiz-history', [ModuleController::class, 'getQuizHistory']);
Route::post('/track-document-download', [ModuleController::class, 'trackDocumentDownload']);

// New quiz timer routes
Route::post('/start-quiz-attempt', [ModuleController::class, 'startQuizAttempt']);
Route::post('/validate-quiz-timer', [ModuleController::class, 'validateQuizTimer']);
Route::get('/quiz-timer-status/{attemptId}', [ModuleController::class, 'getQuizTimerStatus']);

// Activity tracking routes (can be used without authentication for frontend tracking)
Route::prefix('activity')->group(function () {
    Route::post('/track', [ActivityTrackingController::class, 'track']);
    Route::get('/user-activity', [ActivityTrackingController::class, 'getUserActivity']);
    Route::get('/user-progress', [ActivityTrackingController::class, 'getUserProgress']);
    Route::post('/assign-module', [ActivityTrackingController::class, 'assignModule']);
});

// Protected activity tracking routes (require authentication)
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


