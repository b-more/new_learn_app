<?php
// app/Models/UserModuleProgress.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModuleProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'module_id', 'assigned_at', 'first_accessed_at',
        'last_accessed_at', 'total_lessons', 'completed_lessons',
        'total_quizzes', 'completed_quizzes', 'overall_progress', 'status'
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'first_accessed_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'overall_progress' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function calculateProgress()
    {
        $totalItems = $this->total_lessons + $this->total_quizzes;
        $completedItems = $this->completed_lessons + $this->completed_quizzes;

        if ($totalItems > 0) {
            $this->overall_progress = round(($completedItems / $totalItems) * 100, 2);
            $this->status = $this->overall_progress >= 100 ? 'completed' : 'in_progress';
            $this->save();
        }
    }
}
