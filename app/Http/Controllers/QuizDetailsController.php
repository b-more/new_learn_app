<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QuizDetailsController extends Controller
{
    /**
     * Display enhanced quiz attempt details
     */
    public function showQuizDetails(Request $request)
    {
        $userId = $request->get('user_id', auth()->id());

        // Get all quiz attempts for the user, grouped by session
        $attempts = AttemptAnswer::with(['user', 'module', 'lesson', 'quiz'])
            ->where('user_id', $userId)
            ->orderBy('attempt_completed_at', 'desc')
            ->get();

        // Group attempts by lesson and session (same lesson + close timing = same session)
        $groupedAttempts = $this->groupAttemptsBySession($attempts);

        return view('quiz.enhanced-details', compact('groupedAttempts', 'userId'));
    }

    /**
     * Get detailed quiz attempt information for a specific session
     */
    public function getSessionDetails($sessionId)
    {
        // Parse session ID (format: lesson_id_timestamp)
        $parts = explode('_', $sessionId);
        $lessonId = $parts[0];
        $timestamp = $parts[1] . '_' . $parts[2]; // Y-m-d_H-i format

        $sessionAttempts = AttemptAnswer::with(['quiz', 'module', 'lesson'])
            ->where('lesson_id', $lessonId)
            ->where('created_at', 'like', substr($timestamp, 0, 16) . '%') // Match date and hour
            ->orderBy('quiz_id')
            ->get();

        $details = [];
        foreach ($sessionAttempts as $attempt) {
            $quiz = $attempt->quiz;
            if (!$quiz) continue;

            $details[] = [
                'quiz_id' => $quiz->id,
                'question' => $quiz->question,
                'options' => [
                    'A' => $quiz->option_a,
                    'B' => $quiz->option_b,
                    'C' => $quiz->option_c,
                    'D' => $quiz->option_d,
                ],
                'user_answer' => $attempt->user_answer ?? 'UNANSWERED',
                'correct_answer' => $attempt->correct_answer ?? $quiz->correct_answer,
                'is_correct' => $attempt->auto_mark ?? false,
                'was_answered' => $attempt->was_answered ?? ($attempt->user_answer !== null && $attempt->user_answer !== 'UNANSWERED'),
                'answered_at' => $attempt->created_at,
                'attempt_status' => $attempt->attempt_status ?? 'completed',
            ];
        }

        return response()->json([
            'success' => true,
            'details' => $details
        ]);
    }

    /**
     * Download quiz history as text file
     */
    public function downloadHistory(Request $request)
    {
        $userId = $request->get('user_id', auth()->id());
        $sessionId = $request->get('session_id');

        if ($sessionId) {
            // Download specific session
            return $this->downloadSessionHistory($sessionId, $userId);
        } else {
            // Download all quiz history
            return $this->downloadAllHistory($userId);
        }
    }

    /**
     * Download specific session history
     */
    private function downloadSessionHistory($sessionId, $userId)
    {
        // Parse session ID
        $parts = explode('_', $sessionId);
        $lessonId = $parts[0];
        $timestamp = $parts[1] . '_' . $parts[2];

        $sessionAttempts = AttemptAnswer::with(['quiz', 'module', 'lesson', 'user'])
            ->where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->where('created_at', 'like', substr($timestamp, 0, 16) . '%')
            ->orderBy('quiz_id')
            ->get();

        if ($sessionAttempts->isEmpty()) {
            return response()->json(['error' => 'No quiz attempts found'], 404);
        }

        $firstAttempt = $sessionAttempts->first();
        $module = $firstAttempt->module;
        $lesson = $firstAttempt->lesson;
        $user = $firstAttempt->user;

        // Calculate session statistics
        $totalQuestions = $sessionAttempts->count();
        $correctAnswers = $sessionAttempts->where('auto_mark', true)->count();
        $scorePercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
        $status = $scorePercentage >= 70 ? 'PASSED' : 'FAILED';

        // Calculate duration
        $startTime = $sessionAttempts->min('created_at');
        $endTime = $sessionAttempts->max('updated_at');
        $duration = $startTime ? $startTime->diffInSeconds($endTime) : 0;
        $durationFormatted = gmdate('H:i:s', $duration);

        // Generate report content
        $content = $this->generateReportContent([
            'user' => $user->name,
            'module' => $module->title ?? 'Unknown Module',
            'lesson' => $lesson->title ?? 'Unknown Lesson',
            'attempted_at' => $firstAttempt->created_at->format('M j, Y H:i A'),
            'duration' => $durationFormatted,
            'score' => $scorePercentage . '%',
            'status' => $status,
            'submission_type' => $this->getSubmissionType($firstAttempt),
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'attempts' => $sessionAttempts
        ]);

        $filename = sprintf(
            'quiz_history_%s_%s_%s.txt',
            str_replace(' ', '_', strtolower($lesson->title ?? 'quiz')),
            $userId,
            $startTime->format('Y-m-d_H-i')
        );

        return Response::make($content, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Download all quiz history for user
     */
    private function downloadAllHistory($userId)
    {
        $allAttempts = AttemptAnswer::with(['quiz', 'module', 'lesson', 'user'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($allAttempts->isEmpty()) {
            return response()->json(['error' => 'No quiz attempts found'], 404);
        }

        $user = $allAttempts->first()->user;
        $groupedAttempts = $this->groupAttemptsBySession($allAttempts);

        $content = "COMPLETE QUIZ HISTORY REPORT\n";
        $content .= "============================\n\n";
        $content .= "User: {$user->name}\n";
        $content .= "Generated: " . now()->format('M j, Y H:i A') . "\n";
        $content .= "Total Sessions: " . count($groupedAttempts) . "\n\n";

        foreach ($groupedAttempts as $sessionId => $sessionData) {
            $content .= str_repeat('=', 60) . "\n";
            $content .= "SESSION: {$sessionData['module_title']}\n";
            $content .= str_repeat('=', 60) . "\n";
            $content .= "Lesson: {$sessionData['lesson_title']}\n";
            $content .= "Attempted: {$sessionData['attempted_at']}\n";
            $content .= "Duration: {$sessionData['duration']}\n";
            $content .= "Score: {$sessionData['score_percentage']}%\n";
            $content .= "Status: {$sessionData['status']}\n";
            $content .= "Questions: {$sessionData['total_questions']}\n";
            $content .= "Correct: {$sessionData['correct_answers']}\n\n";

            foreach ($sessionData['attempts'] as $index => $attempt) {
                $quiz = $attempt->quiz;
                if (!$quiz) continue;

                $content .= "Question " . ($index + 1) . ": {$quiz->question}\n";
                $content .= "Your Answer: " . ($attempt->user_answer ?? 'UNANSWERED') . "\n";
                $content .= "Correct Answer: {$attempt->correct_answer}\n";
                $content .= "Result: " . ($attempt->auto_mark ? 'CORRECT' : 'INCORRECT') . "\n\n";
            }
            $content .= "\n";
        }

        $filename = sprintf('complete_quiz_history_%s_%s.txt', $userId, now()->format('Y-m-d_H-i'));

        return Response::make($content, 200, [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Group attempts by session (lesson + timing)
     */
    private function groupAttemptsBySession($attempts)
    {
        $grouped = [];

        foreach ($attempts as $attempt) {
            $sessionKey = $attempt->lesson_id . '_' . $attempt->created_at->format('Y-m-d_H-i');

            if (!isset($grouped[$sessionKey])) {
                $lesson = $attempt->lesson;
                $module = $attempt->module;

                // Calculate session stats
                $sessionAttempts = $attempts->where('lesson_id', $attempt->lesson_id)
                    ->where('created_at', '>=', $attempt->created_at->startOfHour())
                    ->where('created_at', '<=', $attempt->created_at->endOfHour());

                $totalQuestions = $sessionAttempts->count();
                $correctAnswers = $sessionAttempts->where('auto_mark', true)->count();
                $scorePercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

                $grouped[$sessionKey] = [
                    'session_id' => $sessionKey,
                    'lesson_id' => $attempt->lesson_id,
                    'module_id' => $attempt->module_id,
                    'module_title' => $module->title ?? 'Unknown Module',
                    'lesson_title' => $lesson->title ?? 'Unknown Lesson',
                    'attempted_at' => $attempt->created_at->format('M j, Y H:i A'),
                    'duration' => $this->calculateSessionDuration($sessionAttempts),
                    'total_questions' => $totalQuestions,
                    'correct_answers' => $correctAnswers,
                    'score_percentage' => $scorePercentage,
                    'status' => $scorePercentage >= 70 ? 'PASSED' : 'FAILED',
                    'submission_type' => $this->getSubmissionType($attempt),
                    'attempts' => $sessionAttempts->sortBy('quiz_id')->values()
                ];
            }
        }

        return collect($grouped)->sortByDesc('attempted_at');
    }

    /**
     * Calculate session duration
     */
    private function calculateSessionDuration($attempts)
    {
        if ($attempts->isEmpty()) return '00:00:00';

        $startTime = $attempts->min('created_at');
        $endTime = $attempts->max('updated_at');

        $duration = $startTime ? $startTime->diffInSeconds($endTime) : 0;
        return gmdate('H:i:s', $duration);
    }

    /**
     * Get submission type label
     */
    private function getSubmissionType($attempt)
    {
        return match($attempt->attempt_status) {
            'timed_out', 'expired' => 'Timeout',
            'completed' => 'Manual',
            'abandoned' => 'Abandoned',
            default => 'Manual'
        };
    }

    /**
     * Generate report content
     */
    private function generateReportContent($data)
    {
        $content = "QUIZ ATTEMPT REPORT\n";
        $content .= "===================\n\n";
        $content .= "User: {$data['user']}\n";
        $content .= "Module: {$data['module']}\n";
        $content .= "Lesson: {$data['lesson']}\n";
        $content .= "Attempted: {$data['attempted_at']}\n";
        $content .= "Duration: {$data['duration']}\n";
        $content .= "Score: {$data['score']}\n";
        $content .= "Status: {$data['status']}\n";
        $content .= "Submission Type: {$data['submission_type']}\n";
        $content .= "Total Questions: {$data['total_questions']}\n";
        $content .= "Correct Answers: {$data['correct_answers']}\n\n";

        $content .= "QUESTION DETAILS\n";
        $content .= "================\n\n";

        foreach ($data['attempts'] as $index => $attempt) {
            $quiz = $attempt->quiz;
            if (!$quiz) continue;

            $content .= "Question " . ($index + 1) . ": {$quiz->question}\n";
            $content .= "Your Answer: " . ($attempt->user_answer ?? 'UNANSWERED') . "\n";
            $content .= "Correct Answer: {$attempt->correct_answer}\n";
            $content .= "Result: " . ($attempt->auto_mark ? 'CORRECT' : 'INCORRECT') . "\n";

            if ($quiz->option_a) {
                $content .= "\nAvailable Options:\n";
                $content .= "  A. {$quiz->option_a}\n";
                $content .= "  B. {$quiz->option_b}\n";
                $content .= "  C. {$quiz->option_c}\n";
                $content .= "  D. {$quiz->option_d}\n";
            }

            $content .= "\n" . str_repeat('-', 50) . "\n\n";
        }

        return $content;
    }
}
