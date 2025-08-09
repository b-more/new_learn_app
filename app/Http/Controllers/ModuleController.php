<?php
// app/Http/Controllers/ModuleController.php - Updated with Session Support

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Models\Lesson;
use App\Models\Quizz;
use App\Models\AttemptAnswer;
use App\Models\UserModuleProgress;
use App\Models\LessonUserActivity;
use App\Services\ActivityTrackingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    protected $activityService;

    public function __construct(ActivityTrackingService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Start quiz attempt - UPDATED with session support (replaces your startQuizAttempt)
     */
    public function startQuizSession(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'lesson_id' => 'required|exists:lessons,id',
                'module_id' => 'required|exists:modules,id',
                'expected_questions' => 'nullable|integer|min:1'
            ]);

            $userId = $request->user_id;
            $lessonId = $request->lesson_id;
            $moduleId = $request->module_id;
            $expectedQuestions = $request->expected_questions;

            $lesson = Lesson::find($lessonId);
            $timerSettings = $lesson->getTimerSettings();

            // Check if user has an active session for this lesson
            $activeSessionId = AttemptAnswer::getActiveSession($userId, $lessonId);

            if ($activeSessionId) {
                Log::info('Quiz session: Resuming existing session', [
                    'user_id' => $userId,
                    'lesson_id' => $lessonId,
                    'existing_session_id' => $activeSessionId
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Resuming existing quiz session',
                    'session_id' => $activeSessionId,
                    'is_new_session' => false,
                    'timer_settings' => $timerSettings
                ]);
            }

            // Generate new session ID
            $sessionId = 'quiz_' . Str::uuid()->toString();
            $sessionStartTime = now();

            // Track lesson access (your existing logic)
            $this->activityService->trackLessonAccess($userId, $lessonId, $moduleId);

            // Log quiz start activity (your existing logic)
            AuditTrail::logActivity(
                $userId,
                'quiz_started',
                'Quiz',
                "Started quiz session for lesson: {$lesson->title}",
                [
                    'resource_id' => $lessonId,
                    'resource_type' => 'quiz',
                    'module_id' => $moduleId,
                    'session_id' => $sessionId,
                    'timer_enabled' => $timerSettings['enabled'],
                    'timer_duration' => $timerSettings['duration_minutes'],
                    'expected_questions' => $expectedQuestions
                ]
            );

            Log::info('Quiz session started successfully', [
                'session_id' => $sessionId,
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'module_id' => $moduleId,
                'timer_enabled' => $timerSettings['enabled'],
                'expected_questions' => $expectedQuestions
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Quiz session started successfully',
                'session_id' => $sessionId,
                'session_started_at' => $sessionStartTime->toISOString(),
                'is_new_session' => true,
                'timer_settings' => $timerSettings,
                'timer_expires_at' => $timerSettings['enabled']
                    ? $sessionStartTime->addMinutes($timerSettings['duration_minutes'])->toISOString()
                    : null,
                'server_time' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            Log::error('Quiz session start error: ' . $e->getMessage(), [
                'user_id' => $request->user_id ?? null,
                'lesson_id' => $request->lesson_id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to start quiz session',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Quiz marking - UPDATED with session support (replaces your marking method)
     */
    public function marking(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'lesson_id' => 'required|exists:lessons,id',
                'module_id' => 'required|exists:modules,id',
                'session_id' => 'required|string' // Now required!
            ]);

            $userId = $request->user_id;
            $lessonId = $request->lesson_id;
            $moduleId = $request->module_id;
            $sessionId = $request->session_id;

            Log::info('Quiz marking started with session', [
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'module_id' => $moduleId,
                'session_id' => $sessionId,
                'request_data' => $request->all()
            ]);

            // Verify session exists and is active
            if (!AttemptAnswer::isSessionActive($sessionId)) {
                throw new \Exception("Invalid or inactive session: {$sessionId}");
            }

            // Check if this is a timeout submission (your existing logic)
            $isTimeoutSubmission = $request->header('X-Timeout-Submission') === 'true';
            $submissionType = $request->header('X-Submission-Type') ?: 'completed';
            $sessionStatus = $isTimeoutSubmission ? 'timed_out' : 'completed';

            // Process quiz answers (your existing logic)
            $quizAnswers = collect($request->all())->filter(function($value, $key) {
                return str_starts_with($key, 'options_');
            })->mapWithKeys(function($value, $key) {
                $quizId = str_replace('options_', '', $key);
                return [$quizId => $value];
            });

            if ($quizAnswers->isEmpty()) {
                throw new \Exception('No quiz answers found in request');
            }

            Log::info('Processing quiz answers for session', [
                'session_id' => $sessionId,
                'answers_count' => $quizAnswers->count(),
                'answers' => $quizAnswers->toArray()
            ]);

            // Get session timing information
            $sessionStartTime = now()->subMinutes(30); // You might want to get this from the session start
            $sessionEndTime = now();

            // Initialize counters (your existing logic)
            $totalQuestions = $quizAnswers->count();
            $correctAnswers = 0;
            $answeredQuestions = 0;
            $unansweredQuestions = 0;
            $answerResult = [];

            // Process each answer and create attempt records (your logic + session_id)
            foreach ($quizAnswers as $quizId => $userAnswer) {
                $quiz = Quizz::find($quizId);

                if (!$quiz) {
                    Log::warning("Quiz not found for ID: {$quizId}");
                    continue;
                }

                // Check if this was an unanswered question (your existing logic)
                $wasAnswered = $userAnswer !== 'UNANSWERED';

                if ($wasAnswered) {
                    $answeredQuestions++;
                } else {
                    $unansweredQuestions++;
                }

                // Determine if answer is correct (your existing logic)
                $isCorrect = $wasAnswered && ($quiz->correct_answer === $userAnswer);

                if ($isCorrect) {
                    $correctAnswers++;
                }

                // Store answer result with additional metadata (your existing logic)
                $answerResult[] = [
                    'quiz_id' => $quizId,
                    'question' => $quiz->question,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $quiz->correct_answer,
                    'is_correct' => $isCorrect,
                    'was_answered' => $wasAnswered,
                    'auto_mark' => $isCorrect,
                ];

                Log::info("Processing question", [
                    'session_id' => $sessionId,
                    'quiz_id' => $quizId,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $quiz->correct_answer,
                    'is_correct' => $isCorrect,
                    'was_answered' => $wasAnswered
                ]);

                // Create attempt answer with session_id (your logic + session support)
                AttemptAnswer::create([
                    'user_id' => $userId,
                    'lesson_id' => $lessonId,
                    'module_id' => $moduleId,
                    'quiz_id' => $quizId,
                    'session_id' => $sessionId, // NEW: Session ID
                    'user_answer' => $wasAnswered ? $userAnswer : null,
                    'correct_answer' => $quiz->correct_answer,
                    'auto_mark' => $isCorrect,
                    'was_answered' => $wasAnswered,
                    'attempt_status' => $sessionStatus,
                    'attempt_started_at' => $sessionStartTime,
                    'attempt_completed_at' => $sessionEndTime,
                    'session_started_at' => $sessionStartTime,
                    'session_completed_at' => $sessionEndTime,
                    'session_status' => $sessionStatus,
                    'total_questions' => $totalQuestions,
                    'correct_answers' => $correctAnswers,
                    'score_percentage' => $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0,
                ]);
            }

            // Calculate pass percentage (your existing logic)
            $passPercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
            $passed = $passPercentage >= 70;

            // Update lesson user activity if passed (your existing logic)
            if ($passed) {
                $lessonActivity = LessonUserActivity::where('user_id', $userId)
                    ->where('lesson_id', $lessonId)
                    ->first();

                if ($lessonActivity) {
                    $lessonActivity->lesson_completed = true;
                    $lessonActivity->save();
                }
            }

            // Enhanced logging for timeout submissions (your existing logic)
            $submissionTypeLabel = $isTimeoutSubmission ? 'timeout' : 'manual';
            Log::info("Quiz completed via {$submissionTypeLabel} submission", [
                'session_id' => $sessionId,
                'total_questions' => $totalQuestions,
                'answered_questions' => $answeredQuestions,
                'unanswered_questions' => $unansweredQuestions,
                'correct_answers' => $correctAnswers,
                'pass_percentage' => $passPercentage,
                'submission_status' => $submissionType
            ]);

            // Log comprehensive activity (your existing logic + session info)
            AuditTrail::logActivity(
                $userId,
                'quiz_completed',
                'Quiz',
                "Completed quiz session {$sessionId} with score: {$passPercentage}% (" .
                ($passed ? 'PASSED' : 'FAILED') . ") via {$submissionTypeLabel} submission",
                [
                    'resource_id' => $lessonId,
                    'resource_type' => 'quiz',
                    'module_id' => $moduleId,
                    'session_id' => $sessionId,
                    'total_questions' => $totalQuestions,
                    'answered_questions' => $answeredQuestions,
                    'unanswered_questions' => $unansweredQuestions,
                    'correct_answers' => $correctAnswers,
                    'score_percentage' => $passPercentage,
                    'pass_status' => $passed ? 'Passed' : 'Failed',
                    'submission_type' => $submissionTypeLabel,
                    'attempt_status' => $submissionType,
                ]
            );

            // Update module progress (your existing logic)
            $this->updateModuleProgress($userId, $moduleId);

            DB::commit();

            Log::info('Quiz marking completed successfully', [
                'session_id' => $sessionId,
                'user_id' => $userId,
                'score_percentage' => $passPercentage,
                'passed' => $passed,
                'correct_answers' => $correctAnswers,
                'total_questions' => $totalQuestions
            ]);

            // Your existing custom response format
            $customResponse = [
                "success" => true,
                "message" => "Quiz completed successfully",
                "session_id" => $sessionId, // NEW: Include session ID
                "total_questions" => $totalQuestions,
                "answered_questions" => $answeredQuestions,
                "unanswered_questions" => $unansweredQuestions,
                "total_correct" => $correctAnswers,
                "total_wrong" => $totalQuestions - $correctAnswers,
                "pass_percentage" => $passPercentage,
                "pass_status" => $passed ? "Passed" : "Failed",
                "submission_type" => $submissionTypeLabel,
                "attempt_status" => $submissionType,
                "session_status" => $sessionStatus, // NEW: Session status
                "results" => $answerResult,
            ];

            Log::info("Quiz Results", $customResponse);
            return response()->json($customResponse);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Quiz marking error: ' . $e->getMessage(), [
                'user_id' => $request->user_id ?? null,
                'lesson_id' => $request->lesson_id ?? null,
                'session_id' => $request->session_id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to complete quiz',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * NEW: Abandon a quiz session - call this when user leaves without completing
     */
    public function abandonQuizSession(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|string'
            ]);

            $sessionId = $request->session_id;

            // Update all attempts in this session to abandoned status
            $updatedCount = AttemptAnswer::where('session_id', $sessionId)
                ->update([
                    'session_completed_at' => now(),
                    'session_status' => 'abandoned'
                ]);

            Log::info('Quiz session abandoned', [
                'session_id' => $sessionId,
                'attempts_updated' => $updatedCount,
                'abandoned_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Quiz session abandoned',
                'session_id' => $sessionId,
                'abandoned_at' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            Log::error('Quiz session abandon error: ' . $e->getMessage(), [
                'session_id' => $request->session_id ?? null,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to abandon session',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * NEW: Get session status - useful for checking if a session is still active
     */
    public function getSessionStatus(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|string'
            ]);

            $sessionId = $request->session_id;
            $stats = AttemptAnswer::getSessionStatsStatic($sessionId);

            if (!$stats) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'session_stats' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get session status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * YOUR EXISTING METHOD - Update module progress based on completed activities
     */
    private function updateModuleProgress($userId, $moduleId)
    {
        try {
            $progress = UserModuleProgress::firstOrCreate(
                ['user_id' => $userId, 'module_id' => $moduleId],
                [
                    'assigned_at' => now(),
                    'first_accessed_at' => now(),
                    'status' => 'in_progress'
                ]
            );

            // Count completed lessons
            $completedLessons = LessonUserActivity::where('user_id', $userId)
                ->where('module_id', $moduleId)
                ->where('lesson_completed', true)
                ->count();

            // UPDATED: Count passed quizzes using session-based approach
            $passedQuizzes = AttemptAnswer::where('user_id', $userId)
                ->where('module_id', $moduleId)
                ->whereNotNull('session_id')
                ->get()
                ->groupBy('session_id')
                ->filter(function ($sessionAttempts) {
                    $sessionStats = AttemptAnswer::getSessionStatsStatic($sessionAttempts->first()->session_id);
                    return $sessionStats && $sessionStats['passed'];
                })
                ->count();

            // Get total lessons and quizzes for this module
            $totalLessons = \App\Models\Lesson::where('module_id', $moduleId)->count();
            $totalQuizzes = DB::table('quizzs')
                ->whereIn('lesson_id', function($query) use ($moduleId) {
                    $query->select('id')->from('lessons')->where('module_id', $moduleId);
                })
                ->distinct('lesson_id')
                ->count();

            // Calculate overall progress
            $totalActivities = $totalLessons + $totalQuizzes;
            $completedActivities = $completedLessons + $passedQuizzes;
            $overallProgress = $totalActivities > 0 ? round(($completedActivities / $totalActivities) * 100, 2) : 0;

            // Determine status
            $status = 'in_progress';
            if ($overallProgress >= 100) {
                $status = 'completed';
            } elseif ($overallProgress == 0) {
                $status = 'assigned';
            }

            // Update progress
            $progress->update([
                'last_accessed_at' => now(),
                'completed_lessons' => $completedLessons,
                'completed_quizzes' => $passedQuizzes,
                'total_lessons' => $totalLessons,
                'total_quizzes' => $totalQuizzes,
                'overall_progress' => $overallProgress,
                'status' => $status
            ]);

            Log::info('Module progress updated', [
                'user_id' => $userId,
                'module_id' => $moduleId,
                'overall_progress' => $overallProgress,
                'status' => $status,
                'completed_lessons' => $completedLessons,
                'completed_quizzes' => $passedQuizzes
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to update module progress: ' . $e->getMessage(), [
                'user_id' => $userId,
                'module_id' => $moduleId
            ]);
        }
    }

    /**
     * YOUR EXISTING METHOD - Get quiz history for a user
     */
    public function getQuizHistory(Request $request)
    {
        try {
            $userId = $request->get('user_id', auth()->id());

            // UPDATED: Use session-based approach for quiz history
            $sessionIds = AttemptAnswer::where('user_id', $userId)
                ->whereNotNull('session_id')
                ->where('session_status', '!=', 'in_progress')
                ->distinct('session_id')
                ->orderBy('session_completed_at', 'desc')
                ->pluck('session_id');

            $history = [];
            foreach ($sessionIds as $sessionId) {
                $sessionStats = AttemptAnswer::getSessionStatsStatic($sessionId);
                if ($sessionStats) {
                    $history[] = $sessionStats;
                }
            }

            return response()->json([
                'success' => true,
                'data' => $history
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get quiz history: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve quiz history'
            ], 500);
        }
    }

    // Add this method to your ModuleController.php class

    /**
     * Get module lessons summary for assigned modules page
     */
    public function getModuleLessons(Request $request)
    {
        try {
            $request->validate([
                'module_id' => 'required|exists:modules,id'
            ]);

            $moduleId = $request->module_id;

            // Check if user has access to this module
            if (auth()->check()) {
                $hasAccess = auth()->user()->modules()->where('module_id', $moduleId)->exists();
                if (!$hasAccess) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Access denied to this module'
                    ], 403);
                }
            }

            // Get module with lessons count
            $module = \App\Models\Module::with('lessons')->find($moduleId);

            if (!$module) {
                return response()->json([
                    'success' => false,
                    'message' => 'Module not found'
                ], 404);
            }

            $totalLessons = $module->lessons->count();

            // Optional: Get user progress if authenticated
            $userProgress = null;
            if (auth()->check()) {
                $userProgress = \App\Models\UserModuleProgress::where('user_id', auth()->id())
                    ->where('module_id', $moduleId)
                    ->first();
            }

            return response()->json([
                'success' => true,
                'total_lessons' => $totalLessons,
                'module' => [
                    'id' => $module->id,
                    'title' => $module->title,
                    'description' => $module->description
                ],
                'progress' => $userProgress ? [
                    'overall_progress' => $userProgress->overall_progress ?? 0,
                    'completed_lessons' => $userProgress->completed_lessons ?? 0,
                    'status' => $userProgress->status ?? 'assigned'
                ] : null
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid module ID',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Failed to get module lessons: ' . $e->getMessage(), [
                'module_id' => $request->module_id ?? null,
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve module lessons'
            ], 500);
        }
    }

    /**
     * LEGACY: Keep your original startQuizAttempt method for backwards compatibility
     */
    public function startQuizAttempt(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'lesson_id' => 'required|exists:lessons,id'
            ]);

            $userId = $request->user_id;
            $lessonId = $request->lesson_id;

            Log::info('Starting quiz attempt for timer', [
                'user_id' => $userId,
                'lesson_id' => $lessonId
            ]);

            // Get lesson
            $lesson = \App\Models\Lesson::find($lessonId);
            if (!$lesson) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lesson not found'
                ], 404);
            }

            // Get timer settings - with fallback if method doesn't exist
            $timerSettings = [
                'enabled' => true,
                'duration_minutes' => 10,
                'duration_seconds' => 600,
                'warning_time_seconds' => 300, // 5 minutes warning
                'show_warning' => true,
                'auto_submit' => true
            ];

            // Try to get custom timer settings if method exists
            if (method_exists($lesson, 'getTimerSettings')) {
                try {
                    $customSettings = $lesson->getTimerSettings();
                    $timerSettings = array_merge($timerSettings, $customSettings);
                } catch (\Exception $e) {
                    Log::warning('Failed to get custom timer settings, using defaults');
                }
            }

            // Calculate expiration time
            $sessionStartTime = now();
            $timerExpiresAt = $timerSettings['enabled']
                ? $sessionStartTime->copy()->addMinutes($timerSettings['duration_minutes'])
                : null;

            // Check for existing active attempt
            $existingAttempt = \App\Models\AttemptAnswer::where('user_id', $userId)
                ->where('lesson_id', $lessonId)
                ->whereIn('attempt_status', ['started', 'in_progress'])
                ->whereNull('attempt_completed_at')
                ->first();

            if ($existingAttempt && $existingAttempt->timer_expires_at) {
                // Return existing attempt with remaining time
                Log::info('Resuming existing quiz attempt', [
                    'attempt_id' => $existingAttempt->id,
                    'expires_at' => $existingAttempt->timer_expires_at
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Quiz attempt resumed',
                    'attempt_id' => $existingAttempt->id,
                    'timer_settings' => $timerSettings,
                    'timer_expires_at' => $existingAttempt->timer_expires_at->toISOString(),
                    'server_time' => now()->toISOString()
                ]);
            }

            // Create new attempt record for timer tracking
            $attempt = \App\Models\AttemptAnswer::create([
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'module_id' => $lesson->module_id,
                'attempt_started_at' => $sessionStartTime,
                'attempt_status' => 'started',
                'timer_settings' => json_encode($timerSettings),
                'timer_expires_at' => $timerExpiresAt,
                'session_started_at' => $sessionStartTime,
                'session_status' => 'in_progress'
            ]);

            // Try to log activity (but don't fail if it doesn't work)
            try {
                $this->activityService?->trackLessonAccess($userId, $lessonId, $lesson->module_id);
            } catch (\Exception $e) {
                Log::warning('Activity tracking failed during quiz start');
            }

            // Simple audit log
            try {
                \App\Models\AuditTrail::create([
                    'user_id' => $userId,
                    'action_type' => 'quiz_started',
                    'module' => 'Quiz',
                    'activity_description' => "Started quiz attempt for lesson: {$lesson->title}",
                    'activity_timestamp' => now(),
                    'additional_data' => json_encode([
                        'lesson_id' => $lessonId,
                        'attempt_id' => $attempt->id,
                        'timer_enabled' => $timerSettings['enabled']
                    ])
                ]);
            } catch (\Exception $e) {
                Log::warning('Audit trail failed during quiz start');
            }

            Log::info('Quiz attempt started successfully for timer', [
                'attempt_id' => $attempt->id,
                'timer_enabled' => $timerSettings['enabled'],
                'expires_at' => $timerExpiresAt?->toISOString()
            ]);

            // Return format expected by timer JavaScript
            return response()->json([
                'success' => true,
                'message' => 'Quiz attempt started successfully',
                'attempt_id' => $attempt->id,
                'timer_settings' => $timerSettings,
                'timer_expires_at' => $timerExpiresAt ? $timerExpiresAt->toISOString() : null,
                'server_time' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            Log::error('Quiz attempt start error: ' . $e->getMessage(), [
                'user_id' => $request->user_id ?? null,
                'lesson_id' => $request->lesson_id ?? null,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to start quiz attempt: ' . $e->getMessage()
            ], 500);
        }
    }
}
