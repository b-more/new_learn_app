<?php
// app/Models/DocumentDownload.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lesson_id', 'document_name', 'document_path',
        'file_type', 'file_size', 'downloaded_at', 'ip_address', 'user_agent'
    ];

    protected $casts = [
        'downloaded_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
