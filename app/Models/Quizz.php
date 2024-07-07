<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use HasFactory;

    protected $fillable = [
        "lesson_id","question","question_image","correct_answer","answer_option_a","answer_option_b","answer_option_b","answer_option_c","answer_option_d","duration"
    ];
}
