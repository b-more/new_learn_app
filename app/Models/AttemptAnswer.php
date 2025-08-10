<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttemptAnswer extends Model
{
    use HasFactory;

    protected $table = 'attempt_answers';

    protected $fillable = [
        'user_id',
        'module_id',
        'lesson_id',
        'quiz_id',
        'session_id', // NEW: Added for session-based tracking
        'user_answer',
        'correct_answer',
        'auto_mark',
        'was_answered', // Your existing field
        'attempt_started_at',
        'attempt_completed_at',
        'attempt_status',
        'timer_expires_at',
        'timer_settings',
        'time_taken_seconds',
        'total_questions',
        'correct_answers',
        'score_percentage',
        'detailed_answers',
        'session_started_at', // Your existing field
        'session_completed_at', // Your existing field
        'session_status' // Your existing field
    ];

    protected $casts = [
        'attempt_started_at' => 'datetime',
        'attempt_completed_at' => 'datetime',
        'timer_expires_at' => 'datetime',
        'session_started_at' => 'datetime', // Added cast for consistency
        'session_completed_at' => 'datetime', // Added cast for consistency
        'timer_settings' => 'array',
        'detailed_answers' => 'array',
        'score_percentage' => 'decimal:2',
        'auto_mark' => 'boolean',
        'was_answered' => 'boolean',
        'user_id' => 'integer',
        'module_id' => 'integer',
        'lesson_id' => 'integer',
        'quiz_id' => 'integer',
        'total_questions' => 'integer',
        'correct_answers' => 'integer',
        'time_taken_seconds' => 'integer'
    ];

    // Your existing relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quizz::class, 'quiz_id');
    }

    // ALL YOUR EXISTING HELPER METHODS (preserved exactly as-is)
    public function isPassed()
    {
        return $this->score_percentage >= 70;
    }

    public function getFormattedScore()
    {
        return number_format($this->score_percentage, 1) . '%';
    }

    public function getFormattedTimeTaken()
    {
        if (!$this->time_taken_seconds) {
            return 'N/A';
        }

        $minutes = floor($this->time_taken_seconds / 60);
        $seconds = $this->time_taken_seconds % 60;

        if ($minutes > 0) {
            return "{$minutes}m {$seconds}s";
        } else {
            return "{$seconds}s";
        }
    }

    public function getStatusBadgeColor()
    {
        return match($this->attempt_status) {
            'started' => 'warning',
            'in_progress' => 'warning',
            'completed' => $this->isPassed() ? 'success' : 'danger',
            'timed_out' => 'danger',
            'expired' => 'danger',
            default => 'gray'
        };
    }

    public function hasExpired()
    {
        return $this->timer_expires_at && now()->gt($this->timer_expires_at);
    }

    public function getRemainingTimeSeconds()
    {
        if (!$this->timer_expires_at) {
            return null;
        }

        $remaining = $this->timer_expires_at->diffInSeconds(now(), false);
        return max(0, $remaining);
    }

    public function getFormattedRemainingTime()
    {
        $seconds = $this->getRemainingTimeSeconds();

        if ($seconds === null) {
            return 'No time limit';
        }

        if ($seconds <= 0) {
            return 'Time expired';
        }

        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;

        return sprintf('%02d:%02d', $minutes, $remainingSeconds);
    }

    public function isInProgress()
    {
        return $this->attempt_status === 'in_progress' && !$this->hasExpired();
    }

    public function isCompleted()
    {
        return in_array($this->attempt_status, ['completed', 'expired', 'timed_out']);
    }

    public function getPassStatus()
    {
        if (!$this->isCompleted() || $this->score_percentage === null) {
            return 'In Progress';
        }

        return $this->score_percentage >= 70 ? 'Passed' : 'Failed';
    }

    public function isTimeoutSubmission()
    {
        return in_array($this->attempt_status, ['timed_out', 'expired']);
    }

    public function isManualSubmission()
    {
        return $this->attempt_status === 'completed' && !$this->isTimeoutSubmission();
    }

    public function wasAnsweredByUser()
    {
        return $this->was_answered === true;
    }

    public function getSubmissionTypeLabel()
    {
        return match($this->attempt_status) {
            'timed_out' => 'Auto-submitted (Timeout)',
            'expired' => 'Auto-submitted (Expired)',
            'completed' => 'Manual Submission',
            'in_progress' => 'In Progress',
            'started' => 'Started',
            default => 'Unknown'
        };
    }

    public function getEnhancedSummary()
    {
        $baseSummary = $this->getSummary();

        return array_merge($baseSummary, [
            'was_answered' => $this->wasAnsweredByUser(),
            'submission_type' => $this->getSubmissionTypeLabel(),
            'is_timeout_submission' => $this->isTimeoutSubmission(),
            'is_manual_submission' => $this->isManualSubmission(),
            'badge_color' => $this->getStatusBadgeColor(),
            'session_id' => $this->session_id, // NEW: Added session info
            'session_stats' => $this->getSessionStats(), // NEW: Session statistics
        ]);
    }

    public function getSummary()
    {
        return [
            'id' => $this->id,
            'status' => $this->attempt_status,
            'score_percentage' => $this->score_percentage,
            'pass_status' => $this->getPassStatus(),
            'total_questions' => $this->total_questions,
            'correct_answers' => $this->correct_answers,
            'time_taken' => $this->getFormattedTimeTaken(),
            'started_at' => $this->attempt_started_at?->format('Y-m-d H:i:s'),
            'completed_at' => $this->attempt_completed_at?->format('Y-m-d H:i:s'),
            'expired' => $this->hasExpired(),
            'remaining_time' => $this->getFormattedRemainingTime(),
            'timer_enabled' => isset($this->timer_settings['enabled']) ? $this->timer_settings['enabled'] : false
        ];
    }

    // ALL YOUR EXISTING SCOPES (preserved exactly as-is)
    public function scopeAnswered($query)
    {
        return $query->where('was_answered', true);
    }

    public function scopeUnanswered($query)
    {
        return $query->where('was_answered', false);
    }

    public function scopeTimeoutSubmissions($query)
    {
        return $query->whereIn('attempt_status', ['timed_out', 'expired']);
    }

    public function scopeManualSubmissions($query)
    {
        return $query->where('attempt_status', 'completed')
                    ->whereNotIn('attempt_status', ['timed_out', 'expired']);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopePassed($query)
    {
        return $query->where('score_percentage', '>=', 70);
    }

    public function scopeFailed($query)
    {
        return $query->where('score_percentage', '<', 70)
                    ->whereNotNull('score_percentage');
    }

    public function scopeInProgress($query)
    {
        return $query->where('attempt_status', 'in_progress')
                    ->where(function ($q) {
                        $q->whereNull('timer_expires_at')
                          ->orWhere('timer_expires_at', '>', now());
                    });
    }

    public function scopeExpired($query)
    {
        return $query->where('attempt_status', 'in_progress')
                    ->where('timer_expires_at', '<=', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('attempt_status', 'completed');
    }

    // NEW: Session-based scopes
    public function scopeBySession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    public function scopeActiveSessions($query)
    {
        return $query->whereIn('session_status', ['in_progress', null]);
    }

    public function scopeCompletedSessions($query)
    {
        return $query->where('session_status', 'completed');
    }

    public function scopeSessionsWithoutId($query)
    {
        return $query->whereNull('session_id');
    }

    // Your existing static method
    public static function expireTimedOutAttempts()
    {
        return self::expired()->update([
            'attempt_status' => 'expired',
            'attempt_completed_at' => now()
        ]);
    }

    // YOUR EXISTING getUserStats METHOD (preserved exactly as-is)
    public static function getUserStats($userId)
    {
        $attempts = self::where('user_id', $userId)->get();

        return [
            'total_attempts' => $attempts->count(),
            'total_questions' => $attempts->count(),
            'total_correct' => $attempts->where('auto_mark', true)->count(),
            'total_answered' => $attempts->where('was_answered', true)->count(),
            'total_unanswered' => $attempts->where('was_answered', false)->count(),
            'timeout_submissions' => $attempts->whereIn('attempt_status', ['timed_out', 'expired'])->count(),
            'manual_submissions' => $attempts->where('attempt_status', 'completed')->count(),
            'overall_percentage' => $attempts->count() > 0
                ? round(($attempts->where('auto_mark', true)->count() / $attempts->count()) * 100, 2)
                : 0,
            'recent_attempts' => $attempts->where('created_at', '>=', now()->subDays(7))->count(),
        ];
    }

    // Your existing method
    public function getSessionGroupKey()
    {
        return $this->lesson_id . '_' . $this->created_at->format('Y-m-d_H-i');
    }

    // NEW SESSION-BASED METHODS (added for the session system)

    /**
     * Get user session count (for quick counting in views)
     */
    public static function getUserSessionCount($userId)
    {
        return self::where('user_id', $userId)
            ->whereNotNull('session_id')
            ->distinct('session_id')
            ->count();
    }

    /**
     * Get user passed sessions count
     */
    public static function getUserPassedSessionsCount($userId)
    {
        $sessionIds = self::where('user_id', $userId)
            ->whereNotNull('session_id')
            ->distinct('session_id')
            ->pluck('session_id');

        $passedCount = 0;
        foreach ($sessionIds as $sessionId) {
            $sessionStats = self::getSessionStatsStatic($sessionId);
            if ($sessionStats && $sessionStats['passed']) {
                $passedCount++;
            }
        }

        return $passedCount;
    }

    /**
     * Get user failed sessions count
     */
    public static function getUserFailedSessionsCount($userId)
    {
        $sessionIds = self::where('user_id', $userId)
            ->whereNotNull('session_id')
            ->distinct('session_id')
            ->pluck('session_id');

        $failedCount = 0;
        foreach ($sessionIds as $sessionId) {
            $sessionStats = self::getSessionStatsStatic($sessionId);
            if ($sessionStats && !$sessionStats['passed']) {
                $failedCount++;
            }
        }

        return $failedCount;
    }

    /**
     * Get session statistics for this attempt's session
     */
    public function getSessionStats()
    {
        if (!$this->session_id) {
            return null;
        }

        return self::getSessionStatsStatic($this->session_id);
    }

    /**
     * Get session statistics (static method)
     */
    public static function getSessionStatsStatic($sessionId)
    {
        $attempts = self::where('session_id', $sessionId)->get();

        if ($attempts->isEmpty()) {
            return null;
        }

        $totalQuestions = $attempts->count();
        $correctAnswers = $attempts->where('auto_mark', true)->count();
        $answeredQuestions = $attempts->where('was_answered', true)->count();
        $scorePercentage = $totalQuestions > 0
            ? round(($correctAnswers / $totalQuestions) * 100, 2)
            : 0;

        return [
            'session_id' => $sessionId,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'answered_questions' => $answeredQuestions,
            'score_percentage' => $scorePercentage,
            'passed' => $scorePercentage >= 70,
            'session_status' => $attempts->first()->session_status ?? 'unknown',
            'started_at' => $attempts->min('session_started_at'),
            'completed_at' => $attempts->max('session_completed_at')
        ];
    }

    /**
     * Get system-wide session statistics
     */
    public static function getSystemWideSessionStats()
    {
        $totalSessions = self::whereNotNull('session_id')
            ->distinct('session_id')
            ->count();

        $allSessionIds = self::whereNotNull('session_id')
            ->distinct('session_id')
            ->pluck('session_id');

        $passedSessions = 0;
        $failedSessions = 0;
        $completedSessions = 0;
        $abandonedSessions = 0;
        $timedOutSessions = 0;

        foreach ($allSessionIds as $sessionId) {
            $stats = self::getSessionStatsStatic($sessionId);
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
            'raw_attempts_count' => self::count()
        ];
    }

    /**
     * Check if this attempt belongs to a completed session
     */
    public function isSessionCompleted()
    {
        return in_array($this->session_status, ['completed', 'abandoned', 'timed_out']);
    }

    /**
     * Check if this attempt belongs to a passed session
     */
    public function isSessionPassed()
    {
        $stats = $this->getSessionStats();
        return $stats ? $stats['passed'] : false;
    }

    /**
     * Check if a session exists and is active
     */
    public static function isSessionActive($sessionId)
    {
        return self::where('session_id', $sessionId)
            ->whereIn('session_status', ['in_progress', 'started', 'completed'])
            ->exists();
    }

    /**
     * Get active session for user and lesson
     */
    public static function getActiveSession($userId, $lessonId)
    {
        $activeSession = self::where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->whereIn('session_status', ['in_progress', 'started'])
            ->whereNotNull('session_id')
            ->orderBy('created_at', 'desc')
            ->first();

        return $activeSession ? $activeSession->session_id : null;
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically set session metadata when creating attempts
        static::creating(function ($attempt) {
            // If session_id is provided but session metadata is missing, fill it
            if ($attempt->session_id && !$attempt->session_started_at) {
                $existingSession = self::where('session_id', $attempt->session_id)->first();
                if ($existingSession) {
                    $attempt->session_started_at = $existingSession->session_started_at;
                    $attempt->session_status = $existingSession->session_status;
                }
            }
        });
    }
}
