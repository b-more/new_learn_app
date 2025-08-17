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

    // =============================================================================
    // RELATIONSHIPS
    // =============================================================================

    /**
     * Module relationship
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }

    /**
     * Branch relationship
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Role relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
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

    public function attemptAnswers()
    {
        return $this->hasMany(AttemptAnswer::class);
    }

    // =============================================================================
    // ACCESSOR ATTRIBUTES (for UserResource)
    // =============================================================================

    /**
     * Get overall completion rate across all assigned modules
     */
    public function getOverallProgressAttribute()
    {
        $totalModules = $this->modules()->count();
        if ($totalModules == 0) return 0;

        $completedModules = $this->moduleProgress()
            ->where('status', 'completed')
            ->count();

        return round(($completedModules / $totalModules) * 100, 1);
    }

    /**
     * Get last activity timestamp
     */
    public function getLastActivityAttribute()
    {
        return $this->activities()
            ->orderBy('activity_timestamp', 'desc')
            ->first()?->activity_timestamp;
    }

    /**
     * Get total quiz attempts count
     */
    public function getTotalQuizAttemptsAttribute()
    {
        return $this->quizAttempts()
            ->where('attempt_status', 'completed')
            ->count();
    }

    /**
     * Get average quiz score percentage
     */
    public function getAverageQuizScoreAttribute()
    {
        return $this->quizAttempts()
            ->where('attempt_status', 'completed')
            ->avg('score_percentage') ?? 0;
    }

    /**
     * Get formatted overall progress with percentage sign
     */
    public function getFormattedProgressAttribute()
    {
        return $this->overall_progress . '%';
    }

    /**
     * Get progress status badge color
     */
    public function getProgressBadgeColorAttribute()
    {
        return match (true) {
            $this->overall_progress >= 100 => 'success',
            $this->overall_progress >= 70 => 'warning',
            $this->overall_progress > 0 => 'info',
            default => 'gray'
        };
    }

    /**
     * Get activity status badge color
     */
    public function getActivityBadgeColorAttribute()
    {
        $lastActivity = $this->last_activity;
        if (!$lastActivity) return 'gray';

        $daysSince = $lastActivity->diffInDays(now());
        return match (true) {
            $daysSince <= 1 => 'success',  // Active today/yesterday
            $daysSince <= 7 => 'warning',  // Active this week
            default => 'danger'            // Inactive
        };
    }

    // =============================================================================
    // HELPER METHODS (your existing methods enhanced)
    // =============================================================================

    /**
     * Get progress for a specific module
     */
    public function getProgressForModule($moduleId)
    {
        return $this->moduleProgress()->where('module_id', $moduleId)->first();
    }

    /**
     * Check if user has completed a module
     */
    public function hasCompletedModule($moduleId)
    {
        $progress = $this->getProgressForModule($moduleId);
        return $progress && $progress->status === 'completed';
    }

    /**
     * Get recent activities with limit
     */
    public function getRecentActivities($limit = 10)
    {
        return $this->activities()
            ->orderBy('activity_timestamp', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get module completion rate (your existing method)
     */
    public function getModuleCompletionRate()
    {
        $totalModules = $this->modules()->count();
        $completedModules = $this->moduleProgress()->where('status', 'completed')->count();

        return $totalModules > 0 ? round(($completedModules / $totalModules) * 100, 2) : 0;
    }

    /**
     * Get total video watch time in seconds
     */
    public function getTotalVideoWatchTime()
    {
        return $this->lessonActivities()->sum('video_watch_time_seconds');
    }

    /**
     * Get formatted video watch time
     */
    public function getFormattedVideoWatchTime()
    {
        $seconds = $this->getTotalVideoWatchTime();
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);

        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        } elseif ($minutes > 0) {
            return "{$minutes}m";
        } else {
            return "{$seconds}s";
        }
    }

    /**
     * Get total documents downloaded count
     */
    public function getTotalDocumentsDownloaded()
    {
        return $this->documentDownloads()->count();
    }

    /**
     * Get average quiz score
     */
    public function getAverageQuizScore()
    {
        return $this->quizAttempts()
            ->where('attempt_status', 'completed')
            ->avg('score_percentage') ?? 0;
    }

    /**
     * Check if user is currently active (has activity in last 7 days)
     */
    public function isActive()
    {
        $lastActivity = $this->last_activity;
        if (!$lastActivity) return false;

        return $lastActivity->diffInDays(now()) <= 7;
    }

    /**
     * Get detailed progress breakdown for tooltips
     */
    public function getDetailedProgressBreakdown()
    {
        return $this->moduleProgress()
            ->with('module')
            ->get()
            ->map(function ($progress) {
                return [
                    'module' => $progress->module->title,
                    'progress' => number_format($progress->overall_progress, 1) . '%',
                    'status' => $progress->status
                ];
            })
            ->toArray();
    }

    /**
     * Get progress summary text for tooltips
     */
    public function getProgressSummaryText()
    {
        $breakdown = $this->getDetailedProgressBreakdown();
        if (empty($breakdown)) return 'No progress data';

        return collect($breakdown)
            ->map(fn($item) => $item['module'] . ': ' . $item['progress'])
            ->join("\n");
    }

    /**
     * Get user statistics summary
     */
    public function getStatsSummary()
    {
        return [
            'assigned_modules' => $this->modules()->count(),
            'completed_modules' => $this->moduleProgress()->where('status', 'completed')->count(),
            'overall_progress' => $this->overall_progress,
            'quiz_attempts' => $this->total_quiz_attempts,
            'average_score' => round($this->average_quiz_score, 1),
            'documents_downloaded' => $this->getTotalDocumentsDownloaded(),
            'video_watch_time' => $this->getFormattedVideoWatchTime(),
            'last_activity' => $this->last_activity?->diffForHumans() ?? 'No activity',
            'is_active' => $this->isActive()
        ];
    }

    // =============================================================================
    // QUERY SCOPES (for filtering in UserResource)
    // =============================================================================

    /**
     * Scope for users who have completed all their modules
     */
    public function scopeCompleted($query)
    {
        return $query->whereHas('moduleProgress', function($q) {
            $q->where('status', 'completed');
        });
    }

    /**
     * Scope for users with modules in progress
     */
    public function scopeInProgress($query)
    {
        return $query->whereHas('moduleProgress', function($q) {
            $q->where('status', 'in_progress');
        });
    }

    /**
     * Scope for users who haven't started their modules
     */
    public function scopeNotStarted($query)
    {
        return $query->whereDoesntHave('moduleProgress')
            ->orWhereHas('moduleProgress', function($q) {
                $q->where('overall_progress', 0);
            });
    }

    /**
     * Scope for active users (activity in last 7 days)
     */
    public function scopeActive($query)
    {
        return $query->whereHas('activities', function($q) {
            $q->where('activity_timestamp', '>=', now()->subDays(7));
        });
    }

    /**
     * Scope for inactive users (no activity in last 7 days)
     */
    public function scopeInactive($query)
    {
        return $query->whereDoesntHave('activities', function($q) {
            $q->where('activity_timestamp', '>=', now()->subDays(7));
        });
    }

    /**
     * Scope for users by progress percentage range
     */
    public function scopeByProgressRange($query, $min = 0, $max = 100)
    {
        return $query->whereHas('moduleProgress', function($q) use ($min, $max) {
            $q->whereBetween('overall_progress', [$min, $max]);
        });
    }

    /**
     * Scope for users by role
     */
    public function scopeByRole($query, $roleId)
    {
        return $query->where('role_id', $roleId);
    }

    /**
     * Scope for users by branch
     */
    public function scopeByBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // =============================================================================
    // UTILITY METHODS
    // =============================================================================

    /**
     * Get user's role name
     */
    public function getRoleName()
    {
        return $this->role->name ?? 'No Role';
    }

    /**
     * Get user's branch name
     */
    public function getBranchName()
    {
        return $this->branch->name ?? 'No Branch';
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Get full user information for display
     */
    public function getDisplayInfo()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getRoleName(),
            'branch' => $this->getBranchName(),
            'progress' => $this->formatted_progress,
            'last_activity' => $this->last_activity?->diffForHumans() ?? 'No activity'
        ];
    }
}
