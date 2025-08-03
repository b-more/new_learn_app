<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    use HasFactory;

    protected $fillable = [
        "lesson_id",
        "question",
        "question_image",
        "correct_answer",
        "answer_option_a",
        "answer_option_b",
        "answer_option_c",
        "answer_option_d",
        "question_duration_seconds" // Renamed from duration for clarity
    ];

    protected $casts = [
        'question_duration_seconds' => 'integer'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function attemptAnswers()
    {
        return $this->hasMany(AttemptAnswer::class, 'lesson_id', 'lesson_id');
    }

    /**
     * Get timer settings from the parent lesson
     */
    public function getTimerSettings()
    {
        return $this->lesson ? $this->lesson->getTimerSettings() : null;
    }

    /**
     * Get the quiz options as an array
     */
    public function getOptionsArray()
    {
        return [
            'A' => $this->answer_option_a,
            'B' => $this->answer_option_b,
            'C' => $this->answer_option_c,
            'D' => $this->answer_option_d,
        ];
    }

    /**
     * Check if the given answer is correct
     */
    public function isCorrectAnswer($answer)
    {
        return strtoupper($answer) === strtoupper($this->correct_answer);
    }

    /**
     * Get question preview (first 50 characters)
     */
    public function getQuestionPreview()
    {
        return strlen($this->question) > 50
            ? substr($this->question, 0, 50) . '...'
            : $this->question;
    }
}
