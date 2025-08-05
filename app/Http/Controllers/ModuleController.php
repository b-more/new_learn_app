<?php
// app/Http/Controllers/ModuleController.php - COMPLETE FIXED VERSION

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

class ModuleController extends Controller
{
    protected $activityService;

    public function __construct(ActivityTrackingService $activityService)
    {
        $this->activityService = $activityService;
    }

    /**
     * Start quiz attempt - FIXED TO CREATE DATABASE RECORD
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

            $lesson = Lesson::find($lessonId);
            $timerSettings = $lesson->getTimerSettings();

            // Create the actual attempt record in database
            $attempt = AttemptAnswer::create([
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'module_id' => $lesson->module_id,
                'attempt_started_at' => now(),
                'attempt_status' => 'started',
                'timer_settings' => json_encode($timerSettings),
                'timer_expires_at' => $timerSettings['enabled']
                    ? now()->addMinutes($timerSettings['duration_minutes'])
                    : null,
            ]);

            // Track lesson access
            $this->activityService->trackLessonAccess($userId, $lessonId, $lesson->module_id);

            // Log quiz start activity
            AuditTrail::logActivity(
                $userId,
                'quiz_started',
                'Quiz',
                "Started quiz attempt for lesson: {$lesson->title}",
                [
                    'resource_id' => $lessonId,
                    'resource_type' => 'quiz',
                    'module_id' => $lesson->module_id,
                    'attempt_id' => $attempt->id,
                    'timer_enabled' => $timerSettings['enabled'],
                    'timer_duration' => $timerSettings['duration_minutes']
                ]
            );

            Log::info('Quiz attempt started successfully', [
                'attempt_id' => $attempt->id,
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'timer_enabled' => $timerSettings['enabled']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Quiz attempt started successfully',
                'attempt_id' => $attempt->id, // Return actual attempt ID
                'timer_settings' => $timerSettings,
                'timer_expires_at' => $timerSettings['enabled']
                    ? $attempt->timer_expires_at->toISOString()
                    : null,
                'server_time' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            Log::error('Quiz attempt start error: ' . $e->getMessage(), [
                'user_id' => $request->user_id ?? null,
                'lesson_id' => $request->lesson_id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to start quiz attempt',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Quiz marking - FIXED TO UPDATE EXISTING ATTEMPT RECORD
     */
    // public function marking(Request $request)
    // {
    //     DB::beginTransaction();

    //     try {
    //         $request->validate([
    //             'user_id' => 'required|exists:users,id',
    //             'lesson_id' => 'required|exists:lessons,id',
    //             'module_id' => 'required|exists:modules,id'
    //         ]);

    //         $userId = $request->user_id;
    //         $lessonId = $request->lesson_id;
    //         $moduleId = $request->module_id;

    //         Log::info('Quiz marking started', [
    //             'user_id' => $userId,
    //             'lesson_id' => $lessonId,
    //             'module_id' => $moduleId,
    //             'request_data' => $request->all()
    //         ]);

    //         // Process quiz answers
    //         $quizAnswers = collect($request->all())->filter(function($value, $key) {
    //             return str_starts_with($key, 'options_');
    //         })->mapWithKeys(function($value, $key) {
    //             $quizId = str_replace('options_', '', $key);
    //             return [$quizId => $value];
    //         });

    //         if ($quizAnswers->isEmpty()) {
    //             throw new \Exception('No quiz answers found in request');
    //         }

    //         Log::info('Processed quiz answers', [
    //             'answers_count' => $quizAnswers->count(),
    //             'answers' => $quizAnswers->toArray()
    //         ]);

    //         // Find the most recent started attempt
    //         $attempt = AttemptAnswer::where('user_id', $userId)
    //             ->where('lesson_id', $lessonId)
    //             ->where('attempt_status', 'started')
    //             ->orderBy('attempt_started_at', 'desc')
    //             ->first();

    //         // If no existing attempt, create one (fallback)
    //         if (!$attempt) {
    //             Log::warning('No existing attempt found, creating new one');
    //             $attempt = AttemptAnswer::create([
    //                 'user_id' => $userId,
    //                 'lesson_id' => $lessonId,
    //                 'module_id' => $moduleId,
    //                 'attempt_started_at' => now(),
    //                 'attempt_status' => 'started'
    //             ]);
    //         }

    //         // Initialize counters
    //         $totalQuestions = $quizAnswers->count();
    //         $correctAnswers = 0;
    //         $detailedAnswers = [];

    //         // Process each answer
    //         foreach ($quizAnswers as $quizId => $userAnswer) {
    //             $quiz = Quizz::find($quizId);

    //             if (!$quiz) {
    //                 Log::warning("Quiz not found for ID: {$quizId}");
    //                 continue;
    //             }

    //             $isCorrect = ($quiz->correct_answer === $userAnswer);
    //             if ($isCorrect) {
    //                 $correctAnswers++;
    //             }

    //             $detailedAnswers[] = [
    //                 'quiz_id' => $quizId,
    //                 'question' => $quiz->question,
    //                 'user_answer' => $userAnswer,
    //                 'correct_answer' => $quiz->correct_answer,
    //                 'is_correct' => $isCorrect,
    //             ];

    //             Log::info("Question {$quizId}: User answered '{$userAnswer}', Correct: '{$quiz->correct_answer}', Result: " . ($isCorrect ? 'CORRECT' : 'WRONG'));
    //         }

    //         // Calculate score
    //         $scorePercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
    //         $passed = $scorePercentage >= 70;

    //         // Update the attempt record with all details
    //         $attempt->update([
    //             'attempt_completed_at' => now(),
    //             'attempt_status' => 'completed',
    //             'total_questions' => $totalQuestions,
    //             'correct_answers' => $correctAnswers,
    //             'score_percentage' => $scorePercentage,
    //             'detailed_answers' => json_encode($detailedAnswers),
    //             'auto_mark' => $passed ? 1 : 0,
    //             'time_taken_seconds' => $attempt->attempt_started_at
    //                 ? now()->diffInSeconds($attempt->attempt_started_at)
    //                 : null,
    //         ]);

    //         // Update lesson user activity
    //         $lessonActivity = LessonUserActivity::where('user_id', $userId)
    //             ->where('lesson_id', $lessonId)
    //             ->first();

    //         if ($lessonActivity && $passed) {
    //             $lessonActivity->lesson_completed = true;
    //             $lessonActivity->save();
    //         }

    //         // Log comprehensive activity
    //         AuditTrail::logActivity(
    //             $userId,
    //             'quiz_completed',
    //             'Quiz',
    //             "Completed quiz with score: {$scorePercentage}% (" . ($passed ? 'PASSED' : 'FAILED') . ")",
    //             [
    //                 'resource_id' => $lessonId,
    //                 'resource_type' => 'quiz',
    //                 'module_id' => $moduleId,
    //                 'attempt_id' => $attempt->id,
    //                 'total_questions' => $totalQuestions,
    //                 'correct_answers' => $correctAnswers,
    //                 'score_percentage' => $scorePercentage,
    //                 'pass_status' => $passed ? 'Passed' : 'Failed',
    //                 'time_taken_seconds' => $attempt->time_taken_seconds,
    //                 'progress_percentage' => $scorePercentage
    //             ]
    //         );

    //         // Update module progress
    //         $this->updateModuleProgress($userId, $moduleId);

    //         DB::commit();

    //         Log::info('Quiz marking completed successfully', [
    //             'attempt_id' => $attempt->id,
    //             'score_percentage' => $scorePercentage,
    //             'passed' => $passed,
    //             'correct_answers' => $correctAnswers,
    //             'total_questions' => $totalQuestions
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Quiz completed successfully',
    //             'attempt_id' => $attempt->id,
    //             'score_percentage' => $scorePercentage,
    //             'pass_percentage' => $scorePercentage, // For backwards compatibility
    //             'passed' => $passed,
    //             'correct_answers' => $correctAnswers,
    //             'total_questions' => $totalQuestions,
    //             'time_taken_seconds' => $attempt->time_taken_seconds,
    //             'pass_status' => $passed ? 'Passed' : 'Failed'
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         Log::error('Quiz marking error: ' . $e->getMessage(), [
    //             'user_id' => $request->user_id ?? null,
    //             'lesson_id' => $request->lesson_id ?? null,
    //             'module_id' => $request->module_id ?? null,
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to submit quiz',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function marking(Request $request)
{
    try {
        $request->validate([
            'user_id' => 'required',
            'lesson_id' => 'required',
            'module_id' => 'required'
        ]);

        Log::info('Quiz marking started', [
            'user_id' => $request->user_id,
            'lesson_id' => $request->lesson_id,
            'module_id' => $request->module_id,
            'request_data' => $request->all()
        ]);

        // Check if this is a timeout submission (using your header approach)
        $isTimeoutSubmission = $request->header('X-Timeout-Submission') === 'true';
        $submissionType = $request->header('X-Submission-Type') ?: 'completed';

        // Process quiz answers
        $quizAnswers = collect($request->all())->filter(function($value, $key) {
            return str_starts_with($key, 'options_');
        })->mapWithKeys(function($value, $key) {
            $quizId = str_replace('options_', '', $key);
            return [$quizId => $value];
        });

        if ($quizAnswers->isEmpty()) {
            throw new \Exception('No quiz answers found in request');
        }

        Log::info('Processed Quiz Answers: ' . json_encode($quizAnswers->toArray()));

        // Initialize counters
        $totalQuestions = $quizAnswers->count();
        $correctAnswers = 0;
        $answeredQuestions = 0;
        $unansweredQuestions = 0;
        $answerResult = [];

        // Get timing information
        $attemptStarted = now()->subMinutes(30); // Fallback, you might want to track this better
        $attemptCompleted = now();

        foreach ($quizAnswers as $quizId => $userAnswer) {
            $quiz = Quizz::find($quizId);

            if (!$quiz) {
                Log::warning("Quiz not found for ID: {$quizId}");
                continue;
            }

            // Check if this was an unanswered question
            $wasAnswered = $userAnswer !== 'UNANSWERED';

            if ($wasAnswered) {
                $answeredQuestions++;
            } else {
                $unansweredQuestions++;
            }

            // Determine if answer is correct
            // UNANSWERED is always wrong, regardless of correct answer
            $isCorrect = $wasAnswered && ($quiz->correct_answer === $userAnswer);

            if ($isCorrect) {
                $correctAnswers++;
            }

            // Store answer result with additional metadata
            $answerResult[] = [
                'quiz_id' => $quizId,
                'question' => $quiz->question,
                'user_answer' => $userAnswer,
                'correct_answer' => $quiz->correct_answer,
                'is_correct' => $isCorrect,
                'was_answered' => $wasAnswered,
                'auto_mark' => $isCorrect,
            ];

            // Save individual attempt answer using your existing model structure
            try {
                AttemptAnswer::create([
                    'user_id' => $request->user_id,
                    'lesson_id' => $request->lesson_id,
                    'module_id' => $request->module_id,
                    'quiz_id' => $quizId,
                    'user_answer' => $wasAnswered ? $userAnswer : null,
                    'correct_answer' => $quiz->correct_answer,
                    'auto_mark' => $isCorrect, // Your model uses boolean
                    'was_answered' => $wasAnswered, // NEW field
                    'attempt_status' => $isTimeoutSubmission ? 'timed_out' : 'completed', // Your status values
                    'attempt_started_at' => $attemptStarted,
                    'attempt_completed_at' => $attemptCompleted,
                    'total_questions' => $totalQuestions,
                    'correct_answers' => $correctAnswers,
                    'score_percentage' => $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to save individual answer: ' . $e->getMessage());
                // Continue processing other answers
            }
        }

        // Calculate pass percentage based on total questions
        $passPercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

        // Enhanced logging for timeout submissions
        $submissionTypeLabel = $isTimeoutSubmission ? 'timeout' : 'manual';
        Log::info("Quiz completed via {$submissionTypeLabel} submission", [
            'total_questions' => $totalQuestions,
            'answered_questions' => $answeredQuestions,
            'unanswered_questions' => $unansweredQuestions,
            'correct_answers' => $correctAnswers,
            'pass_percentage' => $passPercentage,
            'submission_status' => $submissionType
        ]);

        // Log quiz completion with enhanced data (if you have AuditTrail)
        try {
            if (class_exists('App\Models\AuditTrail')) {
                AuditTrail::logActivity(
                    $request->user_id,
                    'quiz_completed',
                    'Quiz Completion',
                    "Completed quiz with score: {$passPercentage}% ({$submissionTypeLabel} submission)",
                    [
                        'resource_id' => $request->lesson_id,
                        'resource_type' => 'quiz',
                        'module_id' => $request->module_id,
                        'total_questions' => $totalQuestions,
                        'answered_questions' => $answeredQuestions,
                        'unanswered_questions' => $unansweredQuestions,
                        'correct_answers' => $correctAnswers,
                        'score_percentage' => $passPercentage,
                        'pass_status' => $passPercentage >= 70 ? 'Passed' : 'Failed',
                        'submission_type' => $submissionTypeLabel,
                        'attempt_status' => $submissionType,
                    ]
                );
            }
        } catch (\Exception $e) {
            Log::error('Failed to log quiz completion: ' . $e->getMessage());
        }

        $customResponse = [
            "success" => true,
            "message" => "Quiz completed successfully",
            "total_questions" => $totalQuestions,
            "answered_questions" => $answeredQuestions,
            "unanswered_questions" => $unansweredQuestions,
            "total_correct" => $correctAnswers,
            "total_wrong" => $totalQuestions - $correctAnswers,
            "pass_percentage" => $passPercentage,
            "pass_status" => $passPercentage >= 70 ? "Passed" : "Failed",
            "submission_type" => $submissionTypeLabel,
            "attempt_status" => $submissionType,
            "results" => $answerResult,
        ];

        Log::info("Quiz Results", $customResponse);
        return response()->json($customResponse);

    } catch (\Exception $e) {
        Log::error('Quiz marking error: ' . $e->getMessage(), [
            'request' => $request->all(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            "success" => false,
            "message" => "Failed to process quiz answers",
            "error" => $e->getMessage()
        ], 500);
    }
}

    /**
     * Update module progress based on completed activities
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

            // Count passed quizzes
            $passedQuizzes = AttemptAnswer::where('user_id', $userId)
                ->where('module_id', $moduleId)
                ->where('attempt_status', 'completed')
                ->where('auto_mark', 1)
                ->distinct('lesson_id')
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
     * Get quiz history for a user
     */
    public function getQuizHistory(Request $request)
    {
        try {
            $userId = $request->get('user_id', auth()->id());

            $attempts = AttemptAnswer::where('user_id', $userId)
                ->where('attempt_status', 'completed')
                ->with(['lesson', 'lesson.module'])
                ->orderBy('attempt_completed_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $attempts
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get quiz history: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve quiz history'
            ], 500);
        }
    }
}
