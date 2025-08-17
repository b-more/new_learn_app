<?php
// app/Helpers/ActivityHelper.php

namespace App\Helpers;

class ActivityHelper
{
    public static function getActivityIcon($actionType)
    {
        $icons = [
            'user_created' => '👤',
            'module_assigned' => '📚',
            'module_accessed' => '📖',
            'lesson_accessed' => '📄',
            'video_played' => '▶️',
            'video_paused' => '⏸️',
            'video_completed' => '✅',
            'document_downloaded' => '📥',
            'quiz_started' => '❓',
            'quiz_completed' => '🎯',
            'login' => '🔑',
            'logout' => '👋'
        ];

        return $icons[$actionType] ?? '📊';
    }

    public static function getActivityColor($actionType)
    {
        $colors = [
            'user_created' => 'blue',
            'module_assigned' => 'purple',
            'module_accessed' => 'green',
            'lesson_accessed' => 'indigo',
            'video_played' => 'yellow',
            'video_paused' => 'orange',
            'video_completed' => 'green',
            'document_downloaded' => 'teal',
            'quiz_started' => 'red',
            'quiz_completed' => 'emerald',
        ];

        return $colors[$actionType] ?? 'gray';
    }

    public static function formatDuration($seconds)
    {
        if ($seconds < 60) {
            return "{$seconds}s";
        } elseif ($seconds < 3600) {
            $minutes = floor($seconds / 60);
            $remainingSeconds = $seconds % 60;
            return "{$minutes}m {$remainingSeconds}s";
        } else {
            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds % 3600) / 60);
            return "{$hours}h {$minutes}m";
        }
    }
}
