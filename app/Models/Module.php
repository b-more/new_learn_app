<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", 'description', 'icon'
    ];

    /**
     * User relationship
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Activity tracking relationships
     */
    public function userProgress()
    {
        return $this->hasMany(UserModuleProgress::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function lessonActivities()
    {
        return $this->hasMany(LessonUserActivity::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(AttemptAnswer::class);
    }

    /**
     * Helper methods for module analytics
     */
    public function getCompletionRate()
    {
        $totalAssigned = $this->userProgress()->count();
        $completed = $this->userProgress()->where('status', 'completed')->count();

        return $totalAssigned > 0 ? round(($completed / $totalAssigned) * 100, 2) : 0;
    }

    public function getAverageProgress()
    {
        return $this->userProgress()->avg('overall_progress') ?? 0;
    }

    public function getTotalLessons()
    {
        return $this->lessons()->count();
    }

    public function getTotalQuizzes()
    {
        return \DB::table('quizzs')
            ->whereIn('lesson_id', $this->lessons()->pluck('id'))
            ->count();
    }

    public function getActiveUsers()
    {
        return $this->userProgress()
            ->where('status', 'in_progress')
            ->count();
    }

    public function getAverageCompletionTime()
    {
        $completedProgress = $this->userProgress()
            ->where('status', 'completed')
            ->whereNotNull('first_accessed_at')
            ->whereNotNull('last_accessed_at')
            ->get();

        if ($completedProgress->isEmpty()) {
            return 0;
        }

        $totalDays = 0;
        foreach ($completedProgress as $progress) {
            $totalDays += $progress->first_accessed_at->diffInDays($progress->last_accessed_at);
        }

        return round($totalDays / $completedProgress->count(), 1);
    }

    public function getMostAccessedLesson()
    {
        return $this->lessonActivities()
            ->selectRaw('lesson_id, COUNT(*) as access_count')
            ->groupBy('lesson_id')
            ->orderBy('access_count', 'desc')
            ->with('lesson')
            ->first();
    }

    public function getAverageQuizScore()
    {
        return $this->quizAttempts()
            ->where('attempt_status', 'completed')
            ->avg('score_percentage') ?? 0;
    }

    public function getTotalVideoWatchTime()
    {
        return $this->lessonActivities()->sum('video_watch_time_seconds');
    }

    public function getDocumentDownloadCount()
    {
        return \DB::table('document_downloads')
            ->whereIn('lesson_id', $this->lessons()->pluck('id'))
            ->count();
    }

    /**
     * Scope for filtering modules by completion rate
     */
    public function scopeByCompletionRate($query, $minRate = 0, $maxRate = 100)
    {
        return $query->whereHas('userProgress', function($q) use ($minRate, $maxRate) {
            $q->whereBetween('overall_progress', [$minRate, $maxRate]);
        });
    }

    /**
     * Scope for filtering modules with active users
     */
    public function scopeWithActiveUsers($query)
    {
        return $query->whereHas('userProgress', function($q) {
            $q->where('status', 'in_progress');
        });
    }
}
