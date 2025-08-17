<?php

namespace App\Http\Controllers;

use App\Models\AttemptAnswer;
use App\Models\User;
use App\Models\UserModuleProgress;
use App\Models\Permission; // ADD THIS IMPORT
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminUserDashboardController extends Controller
{
    /**
     * Show the user dashboard (for admin viewing any user)
     */
    public function showUserDashboard(Request $request, $userId = null)
    {
        // If no user ID provided, show current user
        $userId = $userId ?? auth()->id();

        // Get the user
        $user = User::findOrFail($userId);

        // Check if current user can view this dashboard
        if (!$this->canViewUserDashboard($userId)) {
            abort(403, 'Unauthorized to view this user dashboard');
        }

        // Get dashboard data
        $dashboardData = $this->getDashboardData($userId);

        // Get all users for admin dropdown (if admin)
        $users = collect();
        if ($this->isAdmin()) {
            $userIds = AttemptAnswer::distinct('user_id')->pluck('user_id');
            $users = User::whereIn('id', $userIds)->orderBy('name')->get();
        }

        return view('admin.user-dashboard', compact('user', 'dashboardData', 'users'));
    }

    /**
     * Download user dashboard as PDF
     */
    public function downloadUserDashboardPDF($userId)
    {
        try {
            // Check permissions
            if (!$this->canViewUserDashboard($userId)) {
                abort(403, 'Unauthorized to download this user dashboard');
            }

            $user = User::findOrFail($userId);
            $dashboardData = $this->getDashboardData($userId);

            $data = [
                'user' => $user,
                'dashboardData' => $dashboardData,
                'generated_at' => now()->format('F d, Y H:i:s'),
                'generated_by' => Auth::user()->name
            ];

            // Generate PDF
            $pdf = Pdf::loadView('pdf.user-dashboard', $data);
            $pdf->setPaper('A4', 'portrait');

            $filename = "user_dashboard_" . str_replace(' ', '_', $user->name) . "_" . date('Y-m-d') . ".pdf";

            Log::info('User dashboard PDF generated', [
                'user_id' => $userId,
                'generated_by' => Auth::id(),
                'filename' => $filename
            ]);

            return $pdf->download($filename);

        } catch (\Exception $e) {
            Log::error('User dashboard PDF generation failed', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to generate dashboard PDF',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get comprehensive dashboard data for a user
     */
    public function getDashboardData($userId)
    {
        // Get all quiz attempts for the user using session-based approach
        $allAttempts = AttemptAnswer::where('user_id', $userId)
            ->with(['quiz', 'module', 'lesson'])
            ->orderBy('created_at', 'desc')
            ->get();

        // If no session-based data, try the older grouping approach
        if ($allAttempts->isEmpty()) {
            return $this->getEmptyDashboardData();
        }

        // Group attempts by session or by lesson+time if no session_id
        $sessionGroups = $allAttempts->groupBy(function($attempt) {
            return $attempt->session_id ?? $attempt->lesson_id . '_' . $attempt->created_at->format('Y-m-d_H-i');
        });

        // Calculate session statistics
        $sessions = [];
        $totalSessions = 0;
        $totalQuestions = 0;
        $totalCorrect = 0;
        $passedSessions = 0;
        $manualSubmissions = 0;
        $timeoutSubmissions = 0;
        $totalDuration = 0;

        foreach ($sessionGroups as $sessionId => $sessionAttempts) {
            $firstAttempt = $sessionAttempts->first();
            $module = $firstAttempt->module;
            $lesson = $firstAttempt->lesson;

            $sessionTotal = $sessionAttempts->count();
            $sessionCorrect = $sessionAttempts->where('auto_mark', true)->count();
            $sessionPercentage = $sessionTotal > 0 ? round(($sessionCorrect / $sessionTotal) * 100, 2) : 0;
            $isPassed = $sessionPercentage >= 70;

            // Calculate duration
            $startTime = $sessionAttempts->min('session_started_at') ?? $sessionAttempts->min('created_at');
            $endTime = $sessionAttempts->max('session_completed_at') ?? $sessionAttempts->max('updated_at');
            $duration = $startTime && $endTime ? $startTime->diffInSeconds($endTime) : 0;

            // Determine submission type
            $submissionType = $this->getSubmissionType($firstAttempt);
            if ($submissionType === 'Manual') {
                $manualSubmissions++;
            } else {
                $timeoutSubmissions++;
            }

            $sessions[] = [
                'session_id' => $sessionId,
                'module_title' => $module->title ?? 'Unknown Module',
                'lesson_title' => $lesson->title ?? 'Unknown Lesson',
                'attempted_at' => $firstAttempt->created_at->format('M j, Y H:i A'),
                'duration' => $duration,
                'duration_formatted' => gmdate('H:i:s', $duration),
                'total_questions' => $sessionTotal,
                'correct_answers' => $sessionCorrect,
                'score_percentage' => $sessionPercentage,
                'status' => $isPassed ? 'PASSED' : 'FAILED',
                'submission_type' => $submissionType,
                'attempts' => $sessionAttempts
            ];

            // Update totals
            $totalSessions++;
            $totalQuestions += $sessionTotal;
            $totalCorrect += $sessionCorrect;
            $totalDuration += $duration;
            if ($isPassed) $passedSessions++;
        }

        // Calculate overall statistics
        $overallScore = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100, 2) : 0;
        $passRate = $totalSessions > 0 ? round(($passedSessions / $totalSessions) * 100, 2) : 0;
        $avgDuration = $totalSessions > 0 ? round($totalDuration / $totalSessions) : 0;
        $unanswered = 0; // Calculate if needed

        return [
            'overall_score' => $overallScore,
            'total_sessions' => $totalSessions,
            'total_questions' => $totalQuestions,
            'total_correct' => $totalCorrect,
            'unanswered' => $unanswered,
            'passed_sessions' => $passedSessions,
            'failed_sessions' => $totalSessions - $passedSessions,
            'pass_rate' => $passRate,
            'avg_duration' => $avgDuration,
            'avg_duration_formatted' => gmdate('H:i:s', $avgDuration),
            'manual_submissions' => $manualSubmissions,
            'timeout_submissions' => $timeoutSubmissions,
            'recent_sessions' => collect($sessions)->sortByDesc('attempted_at')->take(10)->values(),
            'all_sessions' => collect($sessions)->sortByDesc('attempted_at')
        ];
    }

    /**
     * Get empty dashboard data when no attempts exist
     */
    private function getEmptyDashboardData()
    {
        return [
            'overall_score' => 0,
            'total_sessions' => 0,
            'total_questions' => 0,
            'total_correct' => 0,
            'unanswered' => 0,
            'passed_sessions' => 0,
            'failed_sessions' => 0,
            'pass_rate' => 0,
            'avg_duration' => 0,
            'avg_duration_formatted' => '00:00:00',
            'manual_submissions' => 0,
            'timeout_submissions' => 0,
            'recent_sessions' => collect(),
            'all_sessions' => collect()
        ];
    }

    /**
     * Determine submission type
     */
    private function getSubmissionType($attempt)
    {
        $status = $attempt->session_status ?? $attempt->attempt_status ?? 'completed';

        return match($status) {
            'timed_out', 'expired', 'timeout' => 'Timeout',
            'abandoned' => 'Abandoned',
            'completed' => 'Manual',
            default => 'Manual'
        };
    }

    /**
     * Check if current user can view the dashboard for the given user
     */
    private function canViewUserDashboard($userId)
    {
        // User can always view their own dashboard
        if (auth()->id() == $userId) {
            return true;
        }

        // Check if user is admin (you can customize this logic)
        return $this->isAdmin();
    }

    /**
     * Check if current user is admin
     * FIXED: Added local permission check function
     */
    private function isAdmin()
    {
        try {
            // Check if user has admin role
            $user = Auth::user();
            if ($user->role_id == 1) {
                return true;
            }

            // Check quiz score permission using the same logic as UserResource
            if (Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->count() > 0) {
                return Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
            }

            return false;
        } catch (\Exception $e) {
            // Fallback: check if user is role_id 1 (admin)
            return auth()->user()->role_id == 1 ?? false;
        }
    }
}
