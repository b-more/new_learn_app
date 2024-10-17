<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\Lesson;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    public function module(Request $request)
    {
        $request->validate([
            "module_id" => "required"
        ]);

        $total_lessons = Lesson::where("module_id", $request->module_id)->count();

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

        $quiz = Quizz::where("lesson_id",$request->lesson_id)->first();

        $custom_response = [
            "success" => true,
            "message" => "Module meta data fetched",
            "quiz" => $quiz
        ];

        return response()->json($custom_response, 200);
    }

    public function marking(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'lesson_id' => 'required',
            'module_id' => 'required'
        ]);

        // In your controller
        $quizAnswers = collect($request->all())->filter(function($value, $key) {
            return str_starts_with($key, 'options_');
        })->mapWithKeys(function($value, $key) {
            // Extract quiz ID from the 'options_{id}' format
            $quizId = str_replace('options_', '', $key);
            return [$quizId => $value];
        });

        Log::info('Processed Quiz Answers: ' . json_encode($quizAnswers->toArray()));


        // Initialize counters for correct and wrong answers
        $totalQuestions = $quizAnswers->count();
        $correctAnswers = 0;
        $wrongAnswers = 0;
        $answerResult = [];

        foreach ($quizAnswers as $quizId => $userAnswer) {
            // Get the quiz from the database by quiz ID
            $quiz = Quizz::find($quizId);

            if (!$quiz) {
                // If the quiz is not found, skip to the next one
                continue;
            }

            // Check if the answer is correct
            $isCorrect = ($quiz->correct_answer === $userAnswer);

            // Increment the correct or wrong counters
            if ($isCorrect) {
                $correctAnswers++;
            } else {
                $wrongAnswers++;
            }

            // Determine auto_mark status (1 for correct, 0 for wrong)
            $autoMark = $isCorrect ? 1 : 0;

            // Check if the attempt already exists
            $existingAttempt = AttemptAnswer::where("user_id", $request->user_id)
                ->where("module_id", $request->module_id)
                ->where("lesson_id", $request->lesson_id)
                ->where("quiz_id", $quizId)
                ->first();

            if ($existingAttempt) {
                // If the attempt already exists, update it
                $existingAttempt->update([
                    'user_answer' => $userAnswer,
                    'auto_mark' => $autoMark,
                ]);
            } else {
                // If no existing attempt, create a new record
                AttemptAnswer::create([
                    "user_id" => $request->user_id,
                    "module_id" => $request->module_id,
                    "lesson_id" => $request->lesson_id,
                    "quiz_id" => $quizId,
                    "user_answer" => $userAnswer,
                    "auto_mark" => $autoMark,
                ]);
            }

            // Prepare a response message with the quiz question
            $answerResult[] = [
                "quiz_id" => $quizId,
                "question" => $quiz->question,   // Adding the question to the response
                "answer" => $isCorrect ? "Correct" : "Wrong",
                "correct_answer" => $quiz->correct_answer,
            ];
        }

        // Calculate pass mark as percentage
        $passPercentage = ($totalQuestions > 0) ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

        // Custom response with the results of all answers and additional stats
        $customResponse = [
            "success" => true,
            "message" => "Quiz answers processed",
            "total_questions" => $totalQuestions,
            "total_correct" => $correctAnswers,
            "total_wrong" => $wrongAnswers,
            "pass_percentage" => $passPercentage,
            "results" => $answerResult,
        ];

        Log::info("Results", $customResponse);

        return response()->json($customResponse);


    }
}
