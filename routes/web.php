<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\QuizDetailsController;
use App\Http\Controllers\AdminUserDashboardController; // MISSING IMPORT - ADD THIS LINE

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

Route::get('/test-pdf-basic', function() {
    try {
        $html = '<h1>PDF Test</h1><p>This is a basic PDF generation test.</p>';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
        return $pdf->download('test-basic.pdf');
    } catch (\Exception $e) {
        return response('PDF Error: ' . $e->getMessage(), 500);
    }
})->middleware('auth');

// Test quiz PDF generation for a specific user
Route::get('/test-quiz-pdf/{userId}', function($userId) {
    try {
        // Check if user exists
        $user = \App\Models\User::findOrFail($userId);

        // Get some basic attempt data
        $attempts = \App\Models\AttemptAnswer::where('user_id', $userId)
            ->take(5) // Limit to 5 for testing
            ->get();

        if ($attempts->isEmpty()) {
            return response('No quiz attempts found for user ' . $user->name, 404);
        }

        // Group attempts (same logic as in the controller)
        $groupedAttempts = $attempts->groupBy(function($item) {
            return $item->attempt_group_id ?? $item->lesson_id . '_' . $item->created_at->format('Y-m-d_H-i');
        });

        // Convert to format expected by PDF
        $pdfAttempts = [];
        foreach ($groupedAttempts as $groupId => $groupedAnswers) {
            $firstAnswer = $groupedAnswers->first();
            $pdfAttempts[] = (object)[
                'attempt_group_id' => $groupId,
                'module_id' => $firstAnswer->module_id,
                'lesson_id' => $firstAnswer->lesson_id,
                'created_at' => $firstAnswer->created_at,
                'user_id' => $firstAnswer->user_id
            ];
        }

        $data = [
            'attempts' => $pdfAttempts,
            'user' => $user,
            'generated_at' => now()->format('F d, Y H:i:s'),
            'admin_user' => auth()->user()
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('quiz-attempts-pdf', $data);
        return $pdf->download('test-quiz-' . $user->id . '.pdf');

    } catch (\Exception $e) {
        return response('Test PDF Error: ' . $e->getMessage() . "\n\nTrace: " . $e->getTraceAsString(), 500);
    }
})->middleware('auth');

// DASHBOARD ROUTES - Now properly imported
Route::middleware(['auth'])->group(function () {

    // View user dashboard (admins can view any user, users can view their own)
    Route::get('/admin/user-dashboard/{userId?}', [AdminUserDashboardController::class, 'showUserDashboard'])
        ->name('admin.user-dashboard');

    // Download user dashboard PDF
    Route::get('/admin/user-dashboard/{userId}/pdf', [AdminUserDashboardController::class, 'downloadUserDashboardPDF'])
        ->name('admin.user-dashboard.pdf');

    // API endpoint for user dashboard data (if needed for AJAX)
    Route::get('/api/admin/user-dashboard-data/{userId}', [AdminUserDashboardController::class, 'getDashboardDataAPI'])
        ->name('admin.user-dashboard.api');
});
