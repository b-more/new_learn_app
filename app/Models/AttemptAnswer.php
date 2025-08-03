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
        'lesson_id',
        'module_id',
        'quiz_id',
        'user_answer',
        'correct_answer',
        'auto_mark',
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
        'auto_mark' => 'integer',
        'time_taken_seconds' => 'integer',
        'total_questions' => 'integer',
        'correct_answers' => 'integer',
        'score_percentage' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quizz::class, 'quiz_id');
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
     * Get formatted time taken
     */
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
        return in_array($this->attempt_status, ['completed', 'expired']);
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

    /**
     * Get attempt summary
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

    /**
     * Scope for active attempts
     */
    public function scopeInProgress($query)
    {
        return $query->where('attempt_status', 'in_progress')
                    ->where(function ($q) {
                        $q->whereNull('timer_expires_at')
                          ->orWhere('timer_expires_at', '>', now());
                    });
    }

    /**
     * Scope for expired attempts
     */
    public function scopeExpired($query)
    {
        return $query->where('attempt_status', 'in_progress')
                    ->where('timer_expires_at', '<=', now());
    }

    /**
     * Scope for completed attempts
     */
    public function scopeCompleted($query)
    {
        return $query->where('attempt_status', 'completed');
    }

    /**
     * Auto-expire attempts that have timed out
     */
    public static function expireTimedOutAttempts()
    {
        return self::expired()->update([
            'attempt_status' => 'expired',
            'attempt_completed_at' => now()
        ]);
    }
}
