<?php
// app/Models/LessonUserActivity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonUserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lesson_id', 'module_id', 'first_accessed_at',
        'last_accessed_at', 'access_count', 'video_play_count',
        'video_progress_percentage', 'video_watch_time_seconds',
        'video_completed', 'document_downloads', 'lesson_completed'
    ];

    protected $casts = [
        'first_accessed_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'video_progress_percentage' => 'decimal:2',
        'video_completed' => 'boolean',
        'document_downloads' => 'array',
        'lesson_completed' => 'boolean',
        'time_spent_seconds' => 'integer'
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

    public function recordAccess()
    {
        $now = now();

        if (!$this->first_accessed_at) {
            $this->first_accessed_at = $now;
        }

        $this->last_accessed_at = $now;
        $this->access_count += 1;
        $this->save();
    }

    public function updateVideoProgress($percentage, $watchTimeSeconds = null)
    {
        $this->video_progress_percentage = max($this->video_progress_percentage, $percentage);

        if ($watchTimeSeconds) {
            $this->video_watch_time_seconds += $watchTimeSeconds;
        }

        if ($percentage >= 90) {
            $this->video_completed = true;
        }

        $this->save();
        $this->checkLessonCompletion();
    }

    private function checkLessonCompletion()
    {
        if ($this->video_completed) {
            $this->lesson_completed = true;
            $this->save();
        }
    }
}
