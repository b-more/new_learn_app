<?php

namespace App\Helpers;

use App\Models\AttemptAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuizSessionHelper
{
    /**
     * Get user quiz session statistics with detailed logging
     */
    public static function getUserSessionStats($userId, $enableLogging = true)
    {
        if ($enableLogging) {
            Log::info('QuizSessionHelper: Calculating stats for user', [
                'user_id' => $userId,
                'method' => 'getUserSessionStats'
            ]);
        }

        // Get raw attempt count for comparison
        $rawAttemptCount = AttemptAnswer::where('user_id', $userId)->count();

        // Get session-based stats
        $sessionAttempts = AttemptAnswer::where('user_id', $userId)
            ->select(
                'lesson_id',
                DB::raw('DATE(created_at) as attempt_date'),
                DB::raw('HOUR(created_at) as attempt_hour'),
                DB::raw('COUNT(*) as questions_count'),
                DB::raw('SUM(CASE WHEN auto_mark = 1 THEN 1 ELSE 0 END) as correct_count'),
                DB::raw('MIN(created_at) as session_start'),
                DB::raw('MAX(created_at) as session_end')
            )
            ->groupBy('lesson_id', 'attempt_date', 'attempt_hour')
            ->get();

        $totalSessions = $sessionAttempts->count();
        $passedSessions = 0;
        $failedSessions = 0;

        $sessionDetails = [];
        foreach ($sessionAttempts as $session) {
            $scorePercentage = $session->questions_count > 0
                ? round(($session->correct_count / $session->questions_count) * 100, 2)
                : 0;

            $isPassed = $scorePercentage >= 70;

            if ($isPassed) {
                $passedSessions++;
            } else {
                $failedSessions++;
            }

            $sessionDetails[] = [
                'lesson_id' => $session->lesson_id,
                'date' => $session->attempt_date,
                'hour' => $session->attempt_hour,
                'questions' => $session->questions_count,
                'correct' => $session->correct_count,
                'score_percentage' => $scorePercentage,
                'passed' => $isPassed,
                'session_start' => $session->session_start,
                'session_end' => $session->session_end
            ];
        }

        $stats = [
            'user_id' => $userId,
            'total_sessions' => $totalSessions,
            'passed_sessions' => $passedSessions,
            'failed_sessions' => $failedSessions,
            'success_rate' => $totalSessions > 0 ? round(($passedSessions / $totalSessions) * 100, 1) : 0,
            'raw_attempt_count' => $rawAttemptCount,
            'session_details' => $sessionDetails
        ];

        if ($enableLogging) {
            Log::info('QuizSessionHelper: Stats calculated', [
                'user_id' => $userId,
                'stats_summary' => [
                    'total_sessions' => $totalSessions,
                    'passed_sessions' => $passedSessions,
                    'failed_sessions' => $failedSessions,
                    'raw_attempt_count' => $rawAttemptCount,
                    'difference' => $rawAttemptCount - $totalSessions
                ],
                'detailed_sessions' => $sessionDetails
            ]);
        }

        return $stats;
    }

    /**
     * Get system-wide session statistics
     */
    public static function getSystemWideStats($enableLogging = true)
    {
        if ($enableLogging) {
            Log::info('QuizSessionHelper: Calculating system-wide stats');
        }

        $sessionAttempts = AttemptAnswer::select(
                'user_id',
                'lesson_id',
                DB::raw('DATE(created_at) as attempt_date'),
                DB::raw('HOUR(created_at) as attempt_hour'),
                DB::raw('COUNT(*) as questions_count'),
                DB::raw('SUM(CASE WHEN auto_mark = 1 THEN 1 ELSE 0 END) as correct_count')
            )
            ->groupBy('user_id', 'lesson_id', 'attempt_date', 'attempt_hour')
            ->get();

        $totalSessions = $sessionAttempts->count();
        $passedSessions = 0;
        $failedSessions = 0;

        foreach ($sessionAttempts as $session) {
            $scorePercentage = $session->questions_count > 0
                ? ($session->correct_count / $session->questions_count) * 100
                : 0;

            if ($scorePercentage >= 70) {
                $passedSessions++;
            } else {
                $failedSessions++;
            }
        }

        $stats = [
            'total_sessions' => $totalSessions,
            'passed_sessions' => $passedSessions,
            'failed_sessions' => $failedSessions,
            'raw_total_attempts' => AttemptAnswer::count()
        ];

        if ($enableLogging) {
            Log::info('QuizSessionHelper: System-wide stats calculated', $stats);
        }

        return $stats;
    }

    /**
     * Validate session grouping logic
     */
    public static function validateSessionGrouping($userId)
    {
        Log::info('QuizSessionHelper: Validating session grouping', ['user_id' => $userId]);

        $allAttempts = AttemptAnswer::where('user_id', $userId)
            ->orderBy('created_at')
            ->get(['id', 'lesson_id', 'quiz_id', 'created_at', 'auto_mark']);

        $groupedBySession = $allAttempts->groupBy(function($attempt) {
            return $attempt->lesson_id . '_' . $attempt->created_at->format('Y-m-d_H');
        });

        Log::info('QuizSessionHelper: Session grouping validation', [
            'user_id' => $userId,
            'total_attempts' => $allAttempts->count(),
            'total_sessions' => $groupedBySession->count(),
            'sessions' => $groupedBySession->map(function($session, $key) {
                return [
                    'session_key' => $key,
                    'attempt_count' => $session->count(),
                    'lesson_ids' => $session->pluck('lesson_id')->unique()->values(),
                    'quiz_ids' => $session->pluck('quiz_id')->values(),
                    'time_range' => [
                        'start' => $session->min('created_at'),
                        'end' => $session->max('created_at')
                    ]
                ];
            })->toArray()
        ]);

        return $groupedBySession;
    }
}
