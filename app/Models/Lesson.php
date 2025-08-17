<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'video_url',
        'order',
        'video_length',
        'video_thumbnail',
        'documents',
        'quiz_timer_enabled',
        'quiz_timer_minutes',
        'show_timer_warning',
        'warning_time_minutes',
        'auto_submit_on_timeout'
    ];

    protected $casts = [
        'documents' => 'array', // Cast JSON to array
        'quiz_timer_enabled' => 'boolean',
        'show_timer_warning' => 'boolean',
        'auto_submit_on_timeout' => 'boolean',
        'quiz_timer_minutes' => 'integer',
        'warning_time_minutes' => 'integer',
        'order' => 'integer',
        'module_id' => 'integer'
    ];

    protected $attributes = [
        'quiz_timer_enabled' => true,
        'quiz_timer_minutes' => 30,
        'show_timer_warning' => true,
        'warning_time_minutes' => 5,
        'auto_submit_on_timeout' => true,
        'order' => 1
    ];

    // Relationships
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quizz::class);
    }

    public function userActivities()
    {
        return $this->hasMany(LessonUserActivity::class);
    }

    public function attemptAnswers()
    {
        return $this->hasMany(AttemptAnswer::class);
    }

    // Timer-related methods
    // public function getTimerSettings()
    // {
    //     return [
    //         'enabled' => $this->quiz_timer_enabled,
    //         'duration_minutes' => $this->quiz_timer_minutes,
    //         'duration_seconds' => $this->quiz_timer_minutes * 60,
    //         'show_warning' => $this->show_timer_warning,
    //         'warning_time_minutes' => $this->warning_time_minutes,
    //         'warning_time_seconds' => $this->warning_time_minutes * 60,
    //         'auto_submit' => $this->auto_submit_on_timeout
    //     ];
    // }

    public function getTimerSettings()
    {
        // You can customize these settings per lesson
        // For now, returning default settings

        return [
            'enabled' => true,
            'duration_minutes' => 10, // 10 minutes default
            'duration_seconds' => 600, // 10 * 60
            'warning_time_seconds' => 300, // Show warning at 5 minutes remaining
            'show_warning' => true,
            'auto_submit' => true
        ];

        // Alternative: If you have timer settings stored in database
        // return [
        //     'enabled' => $this->timer_enabled ?? true,
        //     'duration_minutes' => $this->timer_duration_minutes ?? 10,
        //     'duration_seconds' => ($this->timer_duration_minutes ?? 10) * 60,
        //     'warning_time_seconds' => $this->timer_warning_seconds ?? 300,
        //     'show_warning' => $this->show_timer_warning ?? true,
        //     'auto_submit' => $this->auto_submit_on_timeout ?? true
        // ];
    }

    public function hasQuizTimer()
    {
        return $this->quiz_timer_enabled && $this->quiz_timer_minutes > 0;
    }

    public function getFormattedTimerDuration()
    {
        if (!$this->hasQuizTimer()) {
            return 'No time limit';
        }

        $minutes = $this->quiz_timer_minutes;

        if ($minutes < 60) {
            return "{$minutes} minute" . ($minutes == 1 ? '' : 's');
        } else {
            $hours = floor($minutes / 60);
            $remainingMinutes = $minutes % 60;

            $hoursText = "{$hours} hour" . ($hours > 1 ? 's' : '');

            if ($remainingMinutes == 0) {
                return $hoursText;
            } else {
                $minutesText = "{$remainingMinutes} minute" . ($remainingMinutes > 1 ? 's' : '');
                return "{$hoursText} {$minutesText}";
            }
        }
    }

    public function getTimerWarningText()
    {
        if (!$this->show_timer_warning) {
            return 'No warning';
        }

        $minutes = $this->warning_time_minutes;
        return "Warning at {$minutes} minute" . ($minutes == 1 ? '' : 's') . " remaining";
    }

    // Media helper methods
    public function hasVideo()
    {
        return !empty($this->video_url);
    }

    public function getVideoUrl()
    {
        return $this->hasVideo() ? asset('storage/' . $this->video_url) : null;
    }

    public function hasThumbnail()
    {
        return !empty($this->video_thumbnail);
    }

    public function getThumbnailUrl()
    {
        return $this->hasThumbnail() ? asset('storage/' . $this->video_thumbnail) : null;
    }

    public function hasDocuments()
    {
        return !empty($this->documents) && is_array($this->documents) && count($this->documents) > 0;
    }

    public function getDocuments()
    {
        if (!$this->hasDocuments()) {
            return [];
        }

        return collect($this->documents)->map(function ($document) {
            return [
                'name' => basename($document),
                'path' => $document,
                'url' => asset('storage/' . $document),
                'size' => $this->getFileSize($document)
            ];
        })->toArray();
    }

    private function getFileSize($path)
    {
        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            $bytes = filesize($fullPath);
            $units = ['B', 'KB', 'MB', 'GB'];

            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }

            return round($bytes, 2) . ' ' . $units[$i];
        }
        return 'Unknown';
    }


    // Quiz statistics
    public function getQuizCount()
    {
        return $this->quizzes()->count();
    }

    public function getCompletedAttemptsCount()
    {
        return $this->attemptAnswers()
            ->where('attempt_status', 'completed')
            ->distinct('user_id')
            ->count();
    }

    public function getAverageScore()
    {
        return $this->attemptAnswers()
            ->where('attempt_status', 'completed')
            ->whereNotNull('score_percentage')
            ->avg('score_percentage');
    }

    public function getPassRate()
    {
        $totalCompleted = $this->attemptAnswers()
            ->where('attempt_status', 'completed')
            ->whereNotNull('score_percentage')
            ->count();

        if ($totalCompleted == 0) {
            return 0;
        }

        $passed = $this->attemptAnswers()
            ->where('attempt_status', 'completed')
            ->where('score_percentage', '>=', 70)
            ->count();

        return round(($passed / $totalCompleted) * 100, 2);
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeByModule($query, $moduleId)
    {
        return $query->where('module_id', $moduleId);
    }

    public function scopeWithTimer($query)
    {
        return $query->where('quiz_timer_enabled', true)
                    ->where('quiz_timer_minutes', '>', 0);
    }

    public function scopeWithoutTimer($query)
    {
        return $query->where('quiz_timer_enabled', false);
    }

    public function scopeWithVideo($query)
    {
        return $query->whereNotNull('video_url')
                    ->where('video_url', '!=', '');
    }

    public function scopeWithDocuments($query)
    {
        return $query->whereNotNull('documents')
                    ->where('documents', '!=', '[]');
    }

    // Accessors for better formatting
    public function getFormattedVideoLengthAttribute()
    {
        return $this->video_length ?: 'N/A';
    }

    public function getDocumentCountAttribute()
    {
        return $this->hasDocuments() ? count($this->documents) : 0;
    }

    public function getTotalFileSizeAttribute()
    {
        if (!$this->hasDocuments()) {
            return 0;
        }

        $totalSize = 0;
        foreach ($this->documents as $document) {
            $fullPath = storage_path('app/public/' . $document);
            if (file_exists($fullPath)) {
                $totalSize += filesize($fullPath);
            }
        }

        return $totalSize;
    }

    public function getFormattedTotalFileSizeAttribute()
    {
        $bytes = $this->total_file_size;
        if ($bytes == 0) return '0 B';

        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
