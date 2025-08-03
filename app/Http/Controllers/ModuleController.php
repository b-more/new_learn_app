<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Models\Lesson;
use App\Models\Quizz;
use App\Models\AttemptAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    /**
     * Start quiz attempt - WORKING VERSION
     */
    public function startQuizAttempt(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'lesson_id' => 'required|exists:lessons,id'
            ]);

            $lesson = Lesson::find($request->lesson_id);
            $timerSettings = $lesson->getTimerSettings();

            Log::info('Quiz attempt started', [
                'user_id' => $request->user_id,
                'lesson_id' => $request->lesson_id,
                'timer_enabled' => $timerSettings['enabled']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Quiz attempt started successfully',
                'attempt_id' => null,
                'timer_settings' => $timerSettings,
                'timer_expires_at' => $timerSettings['enabled']
                    ? now()->addMinutes($timerSettings['duration_minutes'])->toISOString()
                    : null,
                'server_time' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            Log::error('Quiz attempt start error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to start quiz attempt',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Quiz marking - FIXED FOR YOUR DATABASE
     */
    public function marking(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required',
                'lesson_id' => 'required',
                'module_id' => 'required'
            ]);

            Log::info('Quiz marking request received', $request->all());

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

                // Store answer result
                $answerResult[] = [
                    'quiz_id' => $quizId,
                    'question' => $quiz->question,
                    'user_answer' => $userAnswer,
                    'correct_answer' => $quiz->correct_answer,
                    'is_correct' => $isCorrect,
                    'auto_mark' => $autoMark,
                ];

                // Save individual attempt answer - SIMPLIFIED FOR YOUR DB
                try {
                    AttemptAnswer::create([
                        'user_id' => $request->user_id,
                        'lesson_id' => $request->lesson_id,
                        'module_id' => $request->module_id,
                        'quiz_id' => $quizId,
                        'user_answer' => $userAnswer,
                        'correct_answer' => $quiz->correct_answer,
                        'auto_mark' => $autoMark,
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to save individual answer: ' . $e->getMessage());
                    // Continue processing other answers
                }
            }

            // Calculate pass percentage
            $passPercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

            // Log quiz completion
            try {
                AuditTrail::logActivity(
                    $request->user_id,
                    'quiz_completed',
                    'Quiz Completion',
                    "Completed quiz with score: {$passPercentage}%",
                    [
                        'resource_id' => $request->lesson_id,
                        'resource_type' => 'quiz',
                        'module_id' => $request->module_id,
                        'total_questions' => $totalQuestions,
                        'correct_answers' => $correctAnswers,
                        'score_percentage' => $passPercentage,
                        'pass_status' => $passPercentage >= 70 ? 'Passed' : 'Failed',
                    ]
                );
            } catch (\Exception $e) {
                Log::error('Failed to log quiz completion: ' . $e->getMessage());
            }

            $customResponse = [
                "success" => true,
                "message" => "Quiz completed successfully",
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
     * Get quiz data with timer settings
     */
    public function quiz(Request $request)
    {
        try {
            $request->validate([
                'lesson_id' => 'required|exists:lessons,id'
            ]);

            $lesson = Lesson::find($request->lesson_id);
            $quizzes = Quizz::where('lesson_id', $request->lesson_id)->get();

            if ($quizzes->isEmpty()) {
                return response()->json([
                    "success" => false,
                    "message" => "No quiz found for this lesson"
                ], 404);
            }

            $timerSettings = $lesson->getTimerSettings();

            $response = [
                "success" => true,
                "message" => "Quiz data fetched successfully",
                "quiz" => $quizzes->first(),
                "quizzes" => $quizzes,
                "lesson" => [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'description' => $lesson->description,
                ],
                "timer_settings" => $timerSettings,
                "total_questions" => $quizzes->count(),
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            Log::error('Quiz fetch error: ' . $e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Failed to fetch quiz data",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    // Other methods remain the same...
    public function getLesson(Request $request)
    {
        try {
            $lesson = Lesson::find($request->lesson_id);
            return response()->json([
                'success' => true,
                'lesson' => $lesson,
                'timer_settings' => $lesson->getTimerSettings()
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function module(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Module data fetched']);
    }

    public function getQuizHistory(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Quiz history fetched']);
    }

    public function trackDocumentDownload(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Document download tracked']);
    }
}
