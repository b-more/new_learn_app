<?php

namespace App\Exports;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AttemptAnswer;
use App\Models\User;

class QuizAttemptPdfExport
{
    protected $userId;
    protected $attemptGroupId;

    public function __construct($userId, $attemptGroupId = null)
    {
        $this->userId = $userId;
        $this->attemptGroupId = $attemptGroupId;
    }

    public function download()
    {
        $user = User::find($this->userId);

        // If attemptGroupId is provided, get only that attempt
        if ($this->attemptGroupId) {
            $attempts = AttemptAnswer::where('user_id', $this->userId)
                ->where('attempt_group_id', $this->attemptGroupId)
                ->select('attempt_group_id', 'module_id', 'lesson_id', 'created_at')
                ->distinct('attempt_group_id')
                ->orderBy('created_at', 'desc')
                ->get();

            $filename = 'quiz_attempt_'.$user->name.'_'.now()->format('Y-m-d').'.pdf';
        } else {
            // Get all attempts
            $attempts = AttemptAnswer::where('user_id', $this->userId)
                ->select('attempt_group_id', 'module_id', 'lesson_id', 'created_at')
                ->distinct('attempt_group_id')
                ->orderBy('created_at', 'desc')
                ->get();

            $filename = 'quiz_attempts_'.$user->name.'_'.now()->format('Y-m-d').'.pdf';
        }

        $data = [
            'user' => $user,
            'attempts' => $attempts,
            'generated_at' => now()->format('Y-m-d H:i:s'),
        ];

        $pdf = PDF::loadView('exports.quiz-attempts-pdf', $data);
        return $pdf->download($filename);
    }
}
