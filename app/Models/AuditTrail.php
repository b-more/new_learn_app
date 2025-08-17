<?php

// app/Models/AuditTrail.php - Replace your existing content

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AuditTrail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'module', 'action_type', 'resource_id', 'resource_type',
        'activity', 'activity_data', 'activity_timestamp', 'ip_address',
        'user_agent', 'session_id', 'progress_percentage'
    ];

    protected $casts = [
        'activity_data' => 'array',
        'activity_timestamp' => 'datetime',
        'progress_percentage' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $dates = [
        'activity_timestamp',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define activity types
    const ACTIVITY_TYPES = [
        'user_created' => 'User Created',
        'module_assigned' => 'Module Assigned',
        'module_accessed' => 'Module Accessed',
        'lesson_accessed' => 'Lesson Accessed',
        'video_played' => 'Video Played',
        'video_paused' => 'Video Paused',
        'video_completed' => 'Video Completed',
        'document_downloaded' => 'Document Downloaded',
        'quiz_started' => 'Quiz Started',
        'quiz_submitted' => 'Quiz Submitted',
        'quiz_completed' => 'Quiz Completed',
        'login' => 'User Login',
        'logout' => 'User Logout'
    ];

    public static function logActivity($userId, $actionType, $module = null, $activity = null, $additionalData = [])
    {
        try {
            return self::create([
                'user_id' => $userId,
                'module' => $module,
                'action_type' => $actionType,
                'resource_id' => $additionalData['resource_id'] ?? null,
                'resource_type' => $additionalData['resource_type'] ?? null,
                'activity' => $activity,
                'activity_data' => $additionalData,
                'activity_timestamp' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'session_id' => session() ? session()->getId() : null,
                'progress_percentage' => $additionalData['progress_percentage'] ?? null
            ]);
        } catch (\Exception $e) {
            // Log the error but don't break the application
            \Log::error('Failed to log activity: ' . $e->getMessage(), [
                'user_id' => $userId,
                'action_type' => $actionType,
                'module' => $module
            ]);
            return null;
        }
    }

    // Accessor for formatted timestamp
    public function getFormattedTimestampAttribute()
    {
        return $this->activity_timestamp ? $this->activity_timestamp->format('M j, Y H:i:s') : '';
    }

    // Accessor for time ago
    public function getTimeAgoAttribute()
    {
        return $this->activity_timestamp ? $this->activity_timestamp->diffForHumans() : '';
    }

    // Scope for recent activities
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('activity_timestamp', '>=', now()->subDays($days));
    }

    // Scope for specific action types
    public function scopeOfType($query, $actionType)
    {
        return $query->where('action_type', $actionType);
    }

    // Scope for specific user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope for date range
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('activity_timestamp', [$startDate, $endDate]);
    }
}
