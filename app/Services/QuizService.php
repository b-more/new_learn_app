<?php

namespace App\Services;

use App\Models\AttemptAnswer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class QuizSessionService
{
    /**
     * Start a new quiz session
     */
    public static function startSession($userId, $lessonId, $moduleId, $expectedQuestions = null)
    {
        $sessionId = self::generateSessionId();

        Log::info('QuizSession: Starting new session', [
            'session_id' => $sessionId,
            'user_id' => $userId,
            'lesson_id' => $lessonId,
            'module_id' => $moduleId,
            'expected_questions' => $expectedQuestions,
            'started_at' => now()
        ]);

        return [
            'session_id' => $sessionId,
            'session_started_at' => now(),
            'session_status' => 'in_progress'
        ];
    }

    /**
     * Complete a quiz session
     */
    public static function completeSession($sessionId, $sessionStatus = 'completed')
    {
        $completedAt = now();

        // Update all attempts in this session
        $updatedCount = AttemptAnswer::where('session_id', $sessionId)
            ->update([
                'session_completed_at' => $completedAt,
                'session_status' => $sessionStatus
            ]);

        // Get session statistics
        $sessionStats = self::getSessionStats($sessionId);

        Log::info('QuizSession: Session completed', [
            'session_id' => $sessionId,
            'session_status' => $sessionStatus,
            'completed_at' => $completedAt,
            'attempts_updated' => $updatedCount,
            'session_stats' => $sessionStats
        ]);

        return [
            'session_id' => $sessionId,
            'session_completed_at' => $completedAt,
            'session_status' => $sessionStatus,
            'stats' => $sessionStats
        ];
    }

    /**
     * Abandon a session (user left without completing)
     */
    public static function abandonSession($sessionId)
    {
        return self::completeSession($sessionId, 'abandoned');
    }

    /**
     * Mark session as timed out
     */
    public static function timeoutSession($sessionId)
    {
        return self::completeSession($sessionId, 'timed_out');
    }

    /**
     * Get session statistics
     */
    public static function getSessionStats($sessionId)
    {
        $attempts = AttemptAnswer::where('session_id', $sessionId)->get();

        if ($attempts->isEmpty()) {
            return null;
        }

        $totalQuestions = $attempts->count();
        $correctAnswers = $attempts->where('auto_mark', true)->count();
        $answeredQuestions = $attempts->where('was_answered', true)->count();
        $scorePercentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
        $passed = $scorePercentage >= config('quiz.passing_score_threshold', 70);

        $firstAttempt = $attempts->sortBy('created_at')->first();
        $lastAttempt = $attempts->sortBy('created_at')->last();

        return [
            'session_id' => $sessionId,
            'user_id' => $firstAttempt->user_id,
            'lesson_id' => $firstAttempt->lesson_id,
            'module_id' => $firstAttempt->module_id,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'answered_questions' => $answeredQuestions,
            'unanswered_questions' => $totalQuestions - $answeredQuestions,
            'score_percentage' => $scorePercentage,
            'passed' => $passed,
            'session_started_at' => $firstAttempt->session_started_at ?? $firstAttempt->created_at,
            'session_completed_at' => $firstAttempt->session_completed_at,
            'session_status' => $firstAttempt->session_status ?? 'in_progress',
            'duration_seconds' => $firstAttempt->session_started_at && $firstAttempt->session_completed_at
                ? $firstAttempt->session_started_at->diffInSeconds($firstAttempt->session_completed_at)
                : null
        ];
    }

    /**
     * Get user session statistics
     */
    public static function getUserSessionStats($userId)
    {
        $sessions = AttemptAnswer::where('user_id', $userId)
            ->whereNotNull('session_id')
            ->select('session_id')
            ->distinct()
            ->get()
            ->map(function($session) {
                return self::getSessionStats($session->session_id);
            })
            ->filter(); // Remove null results

        $totalSessions = $sessions->count();
        $passedSessions = $sessions->where('passed', true)->count();
        $failedSessions = $sessions->where('passed', false)->count();
        $completedSessions = $sessions->where('session_status', 'completed')->count();
        $abandonedSessions = $sessions->where('session_status', 'abandoned')->count();
        $timedOutSessions = $sessions->where('session_status', 'timed_out')->count();

        return [
            'user_id' => $userId,
            'total_sessions' => $totalSessions,
            'passed_sessions' => $passedSessions,
            'failed_sessions' => $failedSessions,
            'completed_sessions' => $completedSessions,
            'abandoned_sessions' => $abandonedSessions,
            'timed_out_sessions' => $timedOutSessions,
            'success_rate' => $totalSessions > 0 ? round(($passedSessions / $totalSessions) * 100, 1) : 0,
            'completion_rate' => $totalSessions > 0 ? round(($completedSessions / $totalSessions) * 100, 1) : 0,
            'sessions' => $sessions->sortByDesc('session_started_at')->values()->toArray()
        ];
    }

    /**
     * Get system-wide session statistics
     */
    public static function getSystemWideStats()
    {
        $totalSessions = AttemptAnswer::whereNotNull('session_id')
            ->distinct('session_id')
            ->count();

        $allSessionIds = AttemptAnswer::whereNotNull('session_id')
            ->distinct('session_id')
            ->pluck('session_id');

        $passedSessions = 0;
        $failedSessions = 0;
        $completedSessions = 0;
        $abandonedSessions = 0;
        $timedOutSessions = 0;

        foreach ($allSessionIds as $sessionId) {
            $stats = self::getSessionStats($sessionId);
            if ($stats) {
                if ($stats['passed']) $passedSessions++;
                else $failedSessions++;

                switch ($stats['session_status']) {
                    case 'completed':
                        $completedSessions++;
                        break;
                    case 'abandoned':
                        $abandonedSessions++;
                        break;
                    case 'timed_out':
                        $timedOutSessions++;
                        break;
                }
            }
        }

        return [
            'total_sessions' => $totalSessions,
            'passed_sessions' => $passedSessions,
            'failed_sessions' => $failedSessions,
            'completed_sessions' => $completedSessions,
            'abandoned_sessions' => $abandonedSessions,
            'timed_out_sessions' => $timedOutSessions,
            'raw_attempts_count' => AttemptAnswer::count()
        ];
    }

    /**
     * Generate a unique session ID
     */
    private static function generateSessionId()
    {
        return 'quiz_' . Str::uuid()->toString();
    }

    /**
     * Check if a session exists and is active
     */
    public static function isSessionActive($sessionId)
    {
        $session = AttemptAnswer::where('session_id', $sessionId)
            ->whereIn('session_status', ['in_progress', null])
            ->first();

        return $session !== null;
    }

    /**
     * Get active session for user and lesson
     */
    public static function getActiveSession($userId, $lessonId)
    {
        $activeAttempt = AttemptAnswer::where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->whereIn('session_status', ['in_progress', null])
            ->whereNotNull('session_id')
            ->orderBy('created_at', 'desc')
            ->first();

        return $activeAttempt ? $activeAttempt->session_id : null;
    }

    /**
     * Clean up old incomplete sessions (optional maintenance)
     */
    public static function cleanupOldSessions($hoursOld = 24)
    {
        $cutoff = Carbon::now()->subHours($hoursOld);

        $cleanedSessions = AttemptAnswer::where('session_status', 'in_progress')
            ->where('created_at', '<', $cutoff)
            ->update([
                'session_status' => 'abandoned',
                'session_completed_at' => $cutoff
            ]);

        Log::info('QuizSession: Cleaned up old sessions', [
            'cutoff_time' => $cutoff,
            'sessions_cleaned' => $cleanedSessions
        ]);

        return $cleanedSessions;
    }
}
