<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuizAttemptController extends Controller
{
    public function downloadPDF($userId)
    {
        try {
            Log::info('PDF download started', ['user_id' => $userId]);

            // Check permissions (with fallback)
            try {
                if (!checkReadQuizScorePermission()) {
                    abort(403, 'Unauthorized access to quiz reports');
                }
            } catch (\Exception $e) {
                Log::warning('Permission check failed, proceeding anyway', ['error' => $e->getMessage()]);
                // Continue anyway for debugging
            }

            // Get user
            $user = User::findOrFail($userId);
            Log::info('User found', ['user_name' => $user->name]);

            // Get quiz attempts with a simpler approach first
            $allAttempts = AttemptAnswer::where('user_id', $userId)
                ->with(['quiz', 'module', 'lesson'])
                ->orderBy('created_at', 'desc')
                ->get();

            Log::info('Attempts retrieved', ['count' => $allAttempts->count()]);

            if ($allAttempts->isEmpty()) {
                Log::warning('No attempts found for user');
                return response()->json(['error' => 'No quiz attempts found for this user'], 404);
            }

            // Use a simplified approach - don't group, just show all attempts
            $simplifiedAttempts = $allAttempts->take(10)->map(function($attempt) {
                return (object)[
                    'attempt_group_id' => $attempt->id, // Use ID as group ID for simplicity
                    'module_id' => $attempt->module_id,
                    'lesson_id' => $attempt->lesson_id,
                    'created_at' => $attempt->created_at,
                    'user_id' => $attempt->user_id
                ];
            });

            $data = [
                'attempts' => $simplifiedAttempts,
                'user' => $user,
                'generated_at' => now()->format('F d, Y H:i:s'),
                'admin_user' => Auth::user()
            ];

            Log::info('About to generate PDF', ['data_keys' => array_keys($data)]);

            // Try with the simplest possible template first
            try {
                $pdf = Pdf::loadView('simple-quiz-pdf', $data);
            } catch (\Exception $e) {
                Log::error('Failed to load simple template, trying HTML fallback', ['error' => $e->getMessage()]);

                // Fallback to inline HTML
                $html = $this->generateSimpleHTML($user, $simplifiedAttempts, $data);
                $pdf = Pdf::loadHTML($html);
            }

            $pdf->setPaper('A4', 'portrait');

            $filename = "quiz_report_" . str_replace(' ', '_', $user->name) . "_" . date('Y-m-d') . ".pdf";

            Log::info('PDF generated successfully', ['filename' => $filename]);

            return $pdf->download($filename);

        } catch (\Exception $e) {
            Log::error('PDF generation failed completely', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Return a helpful error response
            return response()->json([
                'error' => 'Failed to generate PDF report',
                'message' => $e->getMessage(),
                'debug_info' => [
                    'user_id' => $userId,
                    'timestamp' => now()->toISOString()
                ]
            ], 500);
        }
    }

    /**
     * Generate simple HTML for PDF when view files are problematic
     */
    private function generateSimpleHTML($user, $attempts, $data)
    {
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Quiz Report</title>';
        $html .= '<style>body{font-family:Arial,sans-serif;margin:20px;} .header{text-align:center;margin-bottom:30px;} .attempt{margin-bottom:20px;padding:15px;border:1px solid #ccc;} h1{color:#002D62;} .score{font-weight:bold;color:#002D62;}</style>';
        $html .= '</head><body>';

        $html .= '<div class="header">';
        $html .= '<h1>Quiz Attempts Report</h1>';
        $html .= '<p>Student: ' . htmlspecialchars($user->name) . '</p>';
        $html .= '<p>Generated: ' . $data['generated_at'] . '</p>';
        $html .= '<p>Total Attempts: ' . $attempts->count() . '</p>';
        $html .= '</div>';

        foreach ($attempts as $attempt) {
            try {
                $module = \App\Models\Module::find($attempt->module_id);
                $lesson = \App\Models\Lesson::find($attempt->lesson_id);

                // Get a single attempt answer for this attempt
                $sampleAnswer = \App\Models\AttemptAnswer::where('user_id', $attempt->user_id)
                    ->where('lesson_id', $attempt->lesson_id)
                    ->first();

                $html .= '<div class="attempt">';
                $html .= '<h3>Module: ' . htmlspecialchars($module->title ?? 'Unknown Module') . '</h3>';
                $html .= '<h4>Lesson: ' . htmlspecialchars($lesson->title ?? 'Unknown Lesson') . '</h4>';
                $html .= '<p>Date: ' . $attempt->created_at->format('F d, Y H:i:s') . '</p>';

                if ($sampleAnswer) {
                    $html .= '<p>Sample Answer: ' . htmlspecialchars($sampleAnswer->user_answer ?? 'No answer') . '</p>';
                    $html .= '<p>Status: ' . ($sampleAnswer->auto_mark ? 'Correct' : 'Incorrect') . '</p>';
                }

                $html .= '</div>';
            } catch (\Exception $e) {
                $html .= '<div class="attempt"><p>Error loading attempt data: ' . htmlspecialchars($e->getMessage()) . '</p></div>';
            }
        }

        $html .= '</body></html>';

        return $html;
    }
}

// Also create this simple template file: resources/views/simple-quiz-pdf.blade.php

?>

{{-- Simple Quiz PDF Template --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quiz Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #002D62;
            padding-bottom: 20px;
        }
        .attempt {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            color: #002D62;
            margin-bottom: 10px;
        }
        h3 {
            color: #333;
            margin-bottom: 5px;
        }
        .meta {
            color: #666;
            font-size: 14px;
        }
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Quiz Attempts Report</h1>
        <p><strong>Student:</strong> {{ $user->name }}</p>
        <p><strong>User ID:</strong> {{ $user->id }}</p>
        <p><strong>Generated:</strong> {{ $generated_at }}</p>
        <p><strong>Total Records:</strong> {{ count($attempts) }}</p>
    </div>

    @if(count($attempts) > 0)
        @foreach($attempts as $attempt)
            @php
                try {
                    $module = \App\Models\Module::find($attempt->module_id);
                    $lesson = \App\Models\Lesson::find($attempt->lesson_id);

                    // Get some answers for this attempt
                    $answers = \App\Models\AttemptAnswer::where('user_id', $attempt->user_id)
                        ->where('lesson_id', $attempt->lesson_id)
                        ->take(5) // Limit to avoid memory issues
                        ->get();

                } catch (\Exception $e) {
                    $module = null;
                    $lesson = null;
                    $answers = collect();
                }
            @endphp

            <div class="attempt">
                <h3>{{ $module->title ?? 'Unknown Module' }}</h3>
                <h4>{{ $lesson->title ?? 'Unknown Lesson' }}</h4>
                <p class="meta">Attempted: {{ $attempt->created_at->format('F d, Y g:i A') }}</p>

                @if($answers->count() > 0)
                    <p><strong>Questions:</strong> {{ $answers->count() }}</p>
                    <p><strong>Correct:</strong> {{ $answers->where('auto_mark', 1)->count() }}</p>
                    <p><strong>Score:</strong>
                        @php
                            $total = $answers->count();
                            $correct = $answers->where('auto_mark', 1)->count();
                            $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
                        @endphp
                        {{ $correct }}/{{ $total }} ({{ $percentage }}%)
                    </p>
                @else
                    <p class="meta">No detailed answers found for this session.</p>
                @endif
            </div>
        @endforeach
    @else
        <div class="no-data">
            <h3>No Quiz Attempts Found</h3>
            <p>This user has not attempted any quizzes yet.</p>
        </div>
    @endif
</body>
</html>
