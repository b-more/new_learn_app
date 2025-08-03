<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    public function downloadPDF($userId)
    {
        // Check permissions
        if (!checkReadQuizScorePermission()) {
            abort(403, 'Unauthorized access to quiz reports');
        }

        // Get user and their attempts
        $user = User::findOrFail($userId);

        // Get all attempts grouped by attempt_group_id
        $attempts = AttemptAnswer::where('user_id', $userId)
            ->select('attempt_group_id', 'module_id', 'lesson_id', 'created_at')
            ->distinct('attempt_group_id')
            ->orderBy('created_at', 'desc')
            ->get();

        $generated_at = now()->format('F d, Y H:i:s');
        $admin_user = Auth::user();

        // Generate PDF using the existing template
        $pdf = PDF::loadView('quiz-attempts-pdf', compact(
            'attempts',
            'user',
            'generated_at',
            'admin_user'
        ));

        // Set PDF options
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'defaultFont' => 'Times-Roman'
        ]);

        // Download the PDF
        $filename = "quiz_attempts_{$user->name}_{$user->id}_" . date('Y-m-d') . ".pdf";

        return $pdf->download($filename);
    }
}
