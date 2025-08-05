<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttemptAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_id',
        'lesson_id',
        'quiz_id',
        'user_answer',
        'correct_answer',
        'auto_mark',
        'was_answered', // NEW: Track if question was actually answered by user
        'attempt_started_at',
        'attempt_completed_at',
        'attempt_status',
        'timer_expires_at',
        'timer_settings',
        'time_taken_seconds',
        'total_questions',
        'correct_answers',
        'score_percentage',
        'detailed_answers'
    ];

    protected $casts = [
        'attempt_started_at' => 'datetime',
        'attempt_completed_at' => 'datetime',
        'timer_expires_at' => 'datetime',
        'timer_settings' => 'array',
        'detailed_answers' => 'array',
        'score_percentage' => 'decimal:2',
        'auto_mark' => 'boolean',
        'was_answered' => 'boolean', // NEW: Cast for was_answered field
        'user_id' => 'integer',
        'module_id' => 'integer',
        'lesson_id' => 'integer',
        'quiz_id' => 'integer',
        'total_questions' => 'integer',
        'correct_answers' => 'integer',
        'time_taken_seconds' => 'integer'
    ];

    // Relationships
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
        return $this->belongsTo(Quizz::class);
    }

    // Your existing helper methods (keeping them as-is)
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

    /**
     * Check if the quiz attempt has expired
     */
    public function hasExpired()
    {
        return $this->timer_expires_at && now()->gt($this->timer_expires_at);
    }

    /**
     * Get remaining time in seconds
     */
    public function getRemainingTimeSeconds()
    {
        if (!$this->timer_expires_at) {
            return null; // No timer set
        }

        $remaining = $this->timer_expires_at->diffInSeconds(now(), false);
        return max(0, $remaining);
    }

    /**
     * Get formatted remaining time
     */
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

    /**
     * Check if attempt is in progress
     */
    public function isInProgress()
    {
        return $this->attempt_status === 'in_progress' && !$this->hasExpired();
    }

    /**
     * Check if attempt is completed
     */
    public function isCompleted()
    {
        return in_array($this->attempt_status, ['completed', 'expired', 'timed_out']);
    }

    /**
     * Get pass status
     */
    public function getPassStatus()
    {
        if (!$this->isCompleted() || $this->score_percentage === null) {
            return 'In Progress';
        }

        return $this->score_percentage >= 70 ? 'Passed' : 'Failed';
    }

    // NEW METHODS - Building on your existing structure

    /**
     * Check if this was a timeout submission (using your existing status values)
     */
    public function isTimeoutSubmission()
    {
        return in_array($this->attempt_status, ['timed_out', 'expired']);
    }

    /**
     * Check if this was a manual submission
     */
    public function isManualSubmission()
    {
        return $this->attempt_status === 'completed' && !$this->isTimeoutSubmission();
    }

    /**
     * Check if question was actually answered by user
     */
    public function wasAnsweredByUser()
    {
        return $this->was_answered === true;
    }

    /**
     * Get submission type label (enhanced to work with your status values)
     */
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

    /**
     * Get enhanced attempt summary (building on your existing getSummary)
     */
    public function getEnhancedSummary()
    {
        $baseSummary = $this->getSummary();

        return array_merge($baseSummary, [
            'was_answered' => $this->wasAnsweredByUser(),
            'submission_type' => $this->getSubmissionTypeLabel(),
            'is_timeout_submission' => $this->isTimeoutSubmission(),
            'is_manual_submission' => $this->isManualSubmission(),
            'badge_color' => $this->getStatusBadgeColor(),
        ]);
    }

    /**
     * Get attempt summary (your existing method - keeping as-is)
     */
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

    // NEW SCOPES - Building on your existing ones

    /**
     * Scope for answered questions only
     */
    public function scopeAnswered($query)
    {
        return $query->where('was_answered', true);
    }

    /**
     * Scope for unanswered questions only
     */
    public function scopeUnanswered($query)
    {
        return $query->where('was_answered', false);
    }

    /**
     * Scope for timeout submissions (using your status values)
     */
    public function scopeTimeoutSubmissions($query)
    {
        return $query->whereIn('attempt_status', ['timed_out', 'expired']);
    }

    /**
     * Scope for manual submissions (using your status values)
     */
    public function scopeManualSubmissions($query)
    {
        return $query->where('attempt_status', 'completed')
                    ->whereNotIn('attempt_status', ['timed_out', 'expired']);
    }

    /**
     * Scope for recent attempts (last 7 days)
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for passed attempts
     */
    public function scopePassed($query)
    {
        return $query->where('score_percentage', '>=', 70);
    }

    /**
     * Scope for failed attempts
     */
    public function scopeFailed($query)
    {
        return $query->where('score_percentage', '<', 70)
                    ->whereNotNull('score_percentage');
    }

    // Your existing scopes (keeping them as-is)
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

    /**
     * Auto-expire attempts that have timed out (your existing method)
     */
    public static function expireTimedOutAttempts()
    {
        return self::expired()->update([
            'attempt_status' => 'expired',
            'attempt_completed_at' => now()
        ]);
    }

    // NEW STATIC METHODS - Analytics helpers

    /**
     * Get user performance statistics
     */
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

    /**
     * Get session grouping key (for grouping attempts by quiz session)
     */
    public function getSessionGroupKey()
    {
        return $this->lesson_id . '_' . $this->created_at->format('Y-m-d_H-i');
    }
}
