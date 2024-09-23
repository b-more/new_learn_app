<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        "module_id","title","description","video_url","video_length","video_thumbnail"
    ];

     // Accessor to return the full video URL
     public function getVideoUrlAttribute($value)
     {
         // If video is stored in public/lessons, return the full path
         return asset('storage/lessons/' . $value);
     }
}
