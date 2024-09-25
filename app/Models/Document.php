<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['lesson_id', 'file_path', 'file_type'];

    public function lessons()
    {
        return $this->belongsTo(Lesson::class);
    }
}
