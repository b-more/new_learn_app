<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\Lesson;
use App\Models\Quizz;
use App\Models\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function module(Request $request)
    {
        $request->validate([
            "module_id" => "required"
        ]);

        $total_lessons = Lesson::where("module_id", $request->module_id)->count();

        // Log module access activity
        try {
            AuditTrail::logActivity(
                $request->user_id ?? auth()->id(),
                'module_accessed',
                'Module Access',
                "Accessed module and fetched metadata (Module ID: {$request->module_id})",
                [
                    'resource_id' => $request->module_id,
                    'resource_type' => 'module',
                    'total_lessons' => $total_lessons,
                    'action_details' => 'Module metadata requested'
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to log module access activity: ' . $e->getMessage());
        }

        $custom_response = [
            "success" => true,
            "message" => "Module meta data fetched",
            "id" => $request->module_id,
            "total_lessons" => $total_lessons
        ];

        return response()->json($custom_response, 200);
    }

    public function quiz(Request $request)
    {
        $request->validate([
            "lesson_id" => "required"
        ]);

        $quiz = Quizz::where("lesson_id", $request->lesson_id)->first();

        // Get lesson and module info for logging
        $lesson = Lesson::find($request->lesson_id);
        $moduleId = $lesson ? $lesson->module_id : null;

        // Log quiz access activity
        try {
            AuditTrail::logActivity(
                $request->user_id ?? auth()->id(),
                'quiz_accessed',
                'Quiz Access',
                "Accessed quiz for lesson (Lesson ID: {$request->lesson_id})",
                [
                    'resource_id' => $request->lesson_id,
                    'resource_type' => 'lesson',
                    'module_id' => $moduleId,
                    'quiz_id' => $quiz ? $quiz->id : null,
                    'lesson_title' => $lesson ? $lesson->title : 'Unknown',
                    'action_details' => 'Quiz data requested'
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to log quiz access activity: ' . $e->getMessage());
        }

        $custom_response = [
            "success" => true,
            "message" => "Quiz data fetched",
            "quiz" => $quiz
        ];

        return response()->json($custom_response, 200);
    }

    public function marking(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'lesson_id' => 'required',
                'module_id' => 'required'
            ]);

            Log::info('Quiz marking request received', $request->all());

            // Log quiz attempt start
            try {
                AuditTrail::logActivity(
                    $request->user_id,
                    'quiz_attempt_started',
                    'Quiz Attempt',
                    "Started quiz attempt (Lesson ID: {$request->lesson_id})",
                    [
                        'resource_id' => $request->lesson_id,
                        'resource_type' => 'quiz',
                        'module_id' => $request->module_id,
                        'action_details' => 'Quiz submission received for marking'
                    ]
                );
            } catch (\Exception $e) {
                Log::error('Failed to log quiz attempt start: ' . $e->getMessage());
            }

            // Process quiz answers
            $quizAnswers = collect($request->all())->filter(function($value, $key) {
                return str_starts_with($key, 'options_');
            })->mapWithKeys(function($value, $key) {
                $quizId = str_replace('options_', '', $key);
                return [$quizId => $value];
            });

            Log::info('Processed Quiz Answers: ' . json_encode($quizAnswers->toArray()));

            // Initialize counters
            $totalQuestions = $quizAnswers->count();
            $correctAnswers = 0;
            $answerResult = [];
            $quizDetails = [];

            foreach ($quizAnswers as $quizId => $userAnswer) {
                $quiz = Quizz::find($quizId);

                if (!$quiz) {
                    Log::warning("Quiz not found for ID: {$quizId}");
                    continue;
                }

                $isCorrect = ($quiz->correct_answer === $userAnswer);

                if ($isCorrect) {
                    $correctAnswers++;
                }

                $autoMark = $isCorrect ? 1 : 0;

                // Save attempt answer
                AttemptAnswer::updateOrCreate([
                    "user_id" => $request->user_id,
                    "module_id" => $request->module_id,
                    "lesson_id" => $request->lesson_id,
                    "quiz_id" => $quizId,
                ], [
                    'user_answer' => $userAnswer,
                    'auto_mark' => $autoMark,
                ]);

                $answerResult[] = [
                    "quiz_id" => $quizId,
                    "question" => $quiz->question,
                    "answer" => $isCorrect ? "Correct" : "Wrong",
                    "correct_answer" => $quiz->correct_answer,
                    "user_answer" => $userAnswer
                ];

                // Collect quiz details for logging
                $quizDetails[] = [
                    'quiz_id' => $quizId,
                    'question_preview' => substr($quiz->question, 0, 100) . '...',
                    'user_answer' => $userAnswer,
                    'correct_answer' => $quiz->correct_answer,
                    'is_correct' => $isCorrect
                ];
            }

            // Calculate pass percentage
            $passPercentage = ($totalQuestions > 0) ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

            // Update user progress
            $this->updateUserProgress($request->user_id, $request->module_id, $request->lesson_id, $passPercentage);

            // Log detailed quiz completion activity
            try {
                $lesson = Lesson::find($request->lesson_id);
                $lessonTitle = $lesson ? $lesson->title : "Lesson {$request->lesson_id}";

                AuditTrail::logActivity(
                    $request->user_id,
                    'quiz_completed',
                    'Quiz Completion',
                    "Completed quiz '{$lessonTitle}' with score: {$passPercentage}% ({$correctAnswers}/{$totalQuestions} correct)",
                    [
                        'resource_id' => $request->lesson_id,
                        'resource_type' => 'quiz',
                        'module_id' => $request->module_id,
                        'lesson_title' => $lessonTitle,
                        'score_percentage' => $passPercentage,
                        'total_questions' => $totalQuestions,
                        'correct_answers' => $correctAnswers,
                        'wrong_answers' => $totalQuestions - $correctAnswers,
                        'pass_status' => $passPercentage >= 70 ? 'Passed' : 'Failed',
                        'passing_score' => 70,
                        'quiz_details' => $quizDetails,
                        'completion_time' => now()->toISOString(),
                        'progress_percentage' => $passPercentage
                    ]
                );
            } catch (\Exception $e) {
                Log::error('Failed to log quiz completion activity: ' . $e->getMessage());
            }

            // Log individual question activities for detailed tracking
            try {
                foreach ($quizDetails as $detail) {
                    AuditTrail::logActivity(
                        $request->user_id,
                        'quiz_question_answered',
                        'Quiz Question',
                        "Answered quiz question: " . ($detail['is_correct'] ? 'Correct' : 'Wrong'),
                        [
                            'resource_id' => $detail['quiz_id'],
                            'resource_type' => 'quiz_question',
                            'module_id' => $request->module_id,
                            'lesson_id' => $request->lesson_id,
                            'question_preview' => $detail['question_preview'],
                            'user_answer' => $detail['user_answer'],
                            'is_correct' => $detail['is_correct'],
                            'progress_percentage' => $detail['is_correct'] ? 100 : 0
                        ]
                    );
                }
            } catch (\Exception $e) {
                Log::error('Failed to log individual question activities: ' . $e->getMessage());
            }

            $customResponse = [
                "success" => true,
                "message" => "Quiz answers processed successfully",
                "total_questions" => $totalQuestions,
                "total_correct" => $correctAnswers,
                "total_wrong" => $totalQuestions - $correctAnswers,
                "pass_percentage" => $passPercentage,
                "pass_status" => $passPercentage >= 70 ? "Passed" : "Failed",
                "results" => $answerResult,
            ];

            Log::info("Quiz Results", $customResponse);
            return response()->json($customResponse);

        } catch (\Exception $e) {
            // Log error activity
            try {
                AuditTrail::logActivity(
                    $request->user_id ?? null,
                    'quiz_error',
                    'Quiz Error',
                    "Quiz submission failed: " . $e->getMessage(),
                    [
                        'resource_id' => $request->lesson_id ?? null,
                        'resource_type' => 'quiz',
                        'module_id' => $request->module_id ?? null,
                        'error_message' => $e->getMessage(),
                        'error_trace' => $e->getTraceAsString()
                    ]
                );
            } catch (\Exception $logError) {
                Log::error('Failed to log quiz error activity: ' . $logError->getMessage());
            }

            Log::error('Quiz marking error: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to process quiz submission',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function updateUserProgress($userId, $moduleId, $lessonId, $quizScore)
    {
        // Get total lessons in this module
        $totalLessons = DB::table('lessons')->where('module_id', $moduleId)->count();

        // Get all lesson IDs for this module
        $lessonIds = DB::table('lessons')->where('module_id', $moduleId)->pluck('id');

        // Count lessons where user has passed the quiz (score >= 70%)
        $completedLessons = 0;
        foreach ($lessonIds as $lessonIdCheck) {
            // Get all quiz IDs for this lesson
            $quizIds = DB::table('quizzs')->where('lesson_id', $lessonIdCheck)->pluck('id');

            if ($quizIds->count() > 0) {
                // Count correct answers for this lesson
                $correctCount = DB::table('attempt_answers')
                    ->where('user_id', $userId)
                    ->where('lesson_id', $lessonIdCheck)
                    ->where('auto_mark', 1)
                    ->count();

                $totalCount = $quizIds->count();
                $lessonScore = $totalCount > 0 ? ($correctCount / $totalCount) * 100 : 0;

                if ($lessonScore >= 70) {
                    $completedLessons++;
                }
            }
        }

        // Count total quizzes completed with passing score
        $totalQuizzesPassed = 0;
        foreach ($lessonIds as $lessonIdCheck) {
            $quizIds = DB::table('quizzs')->where('lesson_id', $lessonIdCheck)->pluck('id');

            if ($quizIds->count() > 0) {
                $correctCount = DB::table('attempt_answers')
                    ->where('user_id', $userId)
                    ->where('lesson_id', $lessonIdCheck)
                    ->where('auto_mark', 1)
                    ->count();

                $totalCount = $quizIds->count();
                $lessonScore = $totalCount > 0 ? ($correctCount / $totalCount) * 100 : 0;

                if ($lessonScore >= 70) {
                    $totalQuizzesPassed += $quizIds->count();
                }
            }
        }

        // Get total quizzes in module
        $totalQuizzes = DB::table('quizzs')
            ->whereIn('lesson_id', $lessonIds)
            ->count();

        // Calculate overall progress (based on completed lessons)
        $overallProgress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100, 2) : 0;

        // Determine status
        $previousStatus = DB::table('user_module_progress')
            ->where('user_id', $userId)
            ->where('module_id', $moduleId)
            ->value('status') ?? 'assigned';

        $status = 'assigned';
        if ($overallProgress > 0 && $overallProgress < 100) {
            $status = 'in_progress';
        } elseif ($overallProgress >= 100) {
            $status = 'completed';
        }

        // Get existing record to preserve timestamps
        $existingProgress = DB::table('user_module_progress')
            ->where('user_id', $userId)
            ->where('module_id', $moduleId)
            ->first();

        // Update or create progress record
        DB::table('user_module_progress')->updateOrInsert(
            [
                'user_id' => $userId,
                'module_id' => $moduleId
            ],
            [
                'status' => $status,
                'overall_progress' => $overallProgress,
                'total_lessons' => $totalLessons,
                'completed_lessons' => $completedLessons,
                'total_quizzes' => $totalQuizzes,
                'completed_quizzes' => $totalQuizzesPassed,
                'assigned_at' => $existingProgress->assigned_at ?? now(),
                'first_accessed_at' => $existingProgress->first_accessed_at ?? now(),
                'last_accessed_at' => now(),
                'updated_at' => now(),
                'created_at' => $existingProgress->created_at ?? now()
            ]
        );

        // Log progress update activity
        try {
            $statusChanged = $previousStatus !== $status;
            $progressMessage = "Updated user progress: {$overallProgress}% ({$completedLessons}/{$totalLessons} lessons completed)";

            if ($statusChanged) {
                $progressMessage .= " - Status changed from '{$previousStatus}' to '{$status}'";
            }

            AuditTrail::logActivity(
                $userId,
                'progress_updated',
                'Progress Tracking',
                $progressMessage,
                [
                    'resource_id' => $moduleId,
                    'resource_type' => 'module',
                    'lesson_id' => $lessonId,
                    'previous_status' => $previousStatus,
                    'new_status' => $status,
                    'status_changed' => $statusChanged,
                    'overall_progress' => $overallProgress,
                    'total_lessons' => $totalLessons,
                    'completed_lessons' => $completedLessons,
                    'total_quizzes' => $totalQuizzes,
                    'completed_quizzes' => $totalQuizzesPassed,
                    'current_lesson_score' => $quizScore,
                    'progress_percentage' => $overallProgress,
                    'progress_details' => [
                        'lessons_progress' => "{$completedLessons}/{$totalLessons}",
                        'quizzes_progress' => "{$totalQuizzesPassed}/{$totalQuizzes}",
                        'completion_rate' => $overallProgress
                    ]
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to log progress update activity: ' . $e->getMessage());
        }

        Log::info("Progress updated for user {$userId}, module {$moduleId}: {$overallProgress}%", [
            'total_lessons' => $totalLessons,
            'completed_lessons' => $completedLessons,
            'total_quizzes' => $totalQuizzes,
            'completed_quizzes' => $totalQuizzesPassed,
            'current_lesson_score' => $quizScore,
            'status' => $status,
            'status_changed' => $previousStatus !== $status
        ]);
    }
}
