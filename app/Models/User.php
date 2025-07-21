<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\TrackableActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TrackableActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'branch_id',
        'email',
        'password',
        'user_id',
        'role_id',
        'updated_by'
    ];

    /**
     * Module relationship
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }

    /**
     * Activity tracking relationships
     */
    public function moduleProgress()
    {
        return $this->hasMany(UserModuleProgress::class);
    }

    public function lessonActivities()
    {
        return $this->hasMany(LessonUserActivity::class);
    }

    public function documentDownloads()
    {
        return $this->hasMany(DocumentDownload::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(AttemptAnswer::class);
    }

    public function activities()
    {
        return $this->hasMany(AuditTrail::class);
    }

    /**
     * Helper methods for activity tracking
     */
    public function getProgressForModule($moduleId)
    {
        return $this->moduleProgress()->where('module_id', $moduleId)->first();
    }

    public function hasCompletedModule($moduleId)
    {
        $progress = $this->getProgressForModule($moduleId);
        return $progress && $progress->status === 'completed';
    }

    public function getRecentActivities($limit = 10)
    {
        return $this->activities()
            ->orderBy('activity_timestamp', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getModuleCompletionRate()
    {
        $totalModules = $this->modules()->count();
        $completedModules = $this->moduleProgress()->where('status', 'completed')->count();

        return $totalModules > 0 ? round(($completedModules / $totalModules) * 100, 2) : 0;
    }

    public function getTotalVideoWatchTime()
    {
        return $this->lessonActivities()->sum('video_watch_time_seconds');
    }

    public function getTotalDocumentsDownloaded()
    {
        return $this->documentDownloads()->count();
    }

    public function getAverageQuizScore()
    {
        return $this->quizAttempts()
            ->where('attempt_status', 'completed')
            ->avg('score_percentage') ?? 0;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
