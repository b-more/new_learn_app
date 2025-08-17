<?php
// app/Services/ActivityTrackingService.php

namespace App\Services;

use App\Models\AuditTrail;
use App\Models\UserModuleProgress;
use App\Models\LessonUserActivity;
use App\Models\DocumentDownload;
use App\Models\AttemptAnswer;
use App\Models\User;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class ActivityTrackingService
{
    /**
     * Track user creation
     */
    public function trackUserCreation($userId, $createdByUserId = null)
    {
        return AuditTrail::logActivity(
            $createdByUserId ?? $userId,
            'user_created',
            'User Management',
            "Created new user account (ID: {$userId})",
            [
                'resource_id' => $userId,
                'resource_type' => 'user',
                'target_user_id' => $userId
            ]
        );
    }

    /**
     * Track module assignment to user
     */
    public function trackModuleAssignment($userId, $moduleId, $assignedByUserId = null)
    {
        AuditTrail::logActivity(
            $assignedByUserId ?? $userId,
            'module_assigned',
            'Module Assignment',
            "Assigned module to user (User ID: {$userId}, Module ID: {$moduleId})",
            [
                'resource_id' => $moduleId,
                'resource_type' => 'module',
                'target_user_id' => $userId
            ]
        );

        $module = Module::find($moduleId);
        if ($module) {
            $totalLessons = Lesson::where('module_id', $moduleId)->count();
            $totalQuizzes = DB::table('quizzs')
                ->whereIn('lesson_id', function($query) use ($moduleId) {
                    $query->select('id')->from('lessons')->where('module_id', $moduleId);
                })
                ->count();

            UserModuleProgress::updateOrCreate(
                ['user_id' => $userId, 'module_id' => $moduleId],
                [
                    'assigned_at' => now(),
                    'total_lessons' => $totalLessons,
                    'total_quizzes' => $totalQuizzes,
                    'status' => 'assigned'
                ]
            );
        }
    }

    /**
     * Track module access
     */
    public function trackModuleAccess($userId, $moduleId)
    {
        $progress = UserModuleProgress::where('user_id', $userId)
            ->where('module_id', $moduleId)
            ->first();

        if ($progress) {
            if (!$progress->first_accessed_at) {
                $progress->first_accessed_at = now();
                $progress->status = 'in_progress';
            }
            $progress->last_accessed_at = now();
            $progress->save();
        }

        return AuditTrail::logActivity(
            $userId,
            'module_accessed',
            'Module',
            "Accessed module (Module ID: {$moduleId})",
            [
                'resource_id' => $moduleId,
                'resource_type' => 'module'
            ]
        );
    }

    /**
     * Track lesson access
     */
    public function trackLessonAccess($userId, $lessonId, $moduleId)
    {
        $lessonActivity = LessonUserActivity::firstOrCreate(
            ['user_id' => $userId, 'lesson_id' => $lessonId],
            ['module_id' => $moduleId]
        );

        $lessonActivity->recordAccess();

        AuditTrail::logActivity(
            $userId,
            'lesson_accessed',
            'Lesson',
            "Accessed lesson (Lesson ID: {$lessonId})",
            [
                'resource_id' => $lessonId,
                'resource_type' => 'lesson',
                'module_id' => $moduleId
            ]
        );

        $this->updateModuleProgress($userId, $moduleId);
    }

    /**
     * Track video events
     */
    public function trackVideoEvent($userId, $lessonId, $moduleId, $eventType, $data = [])
    {
        $lessonActivity = LessonUserActivity::where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->first();

        if (!$lessonActivity) {
            $lessonActivity = LessonUserActivity::create([
                'user_id' => $userId,
                'lesson_id' => $lessonId,
                'module_id' => $moduleId
            ]);
        }

        $activity = '';
        $progressPercentage = $data['progress_percentage'] ?? null;

        switch ($eventType) {
            case 'play':
                $lessonActivity->video_play_count += 1;
                $activity = "Started playing video";
                break;

            case 'progress':
                if ($progressPercentage) {
                    $lessonActivity->updateVideoProgress(
                        $progressPercentage,
                        $data['watch_time_seconds'] ?? null
                    );
                }
                $activity = "Video progress updated to {$progressPercentage}%";
                break;

            case 'completed':
                $lessonActivity->updateVideoProgress(100);
                $activity = "Completed watching video";
                $progressPercentage = 100;
                break;

            case 'pause':
                $activity = "Paused video at {$progressPercentage}%";
                break;
        }

        $lessonActivity->save();

        AuditTrail::logActivity(
            $userId,
            "video_{$eventType}",
            'Video',
            $activity . " (Lesson ID: {$lessonId})",
            [
                'resource_id' => $lessonId,
                'resource_type' => 'lesson',
                'module_id' => $moduleId,
                'progress_percentage' => $progressPercentage,
                'video_data' => $data
            ]
        );

        $this->updateModuleProgress($userId, $moduleId);
    }

    /**
     * Track document download
     */
    public function trackDocumentDownload($userId, $lessonId, $documentPath, $documentName)
    {
        $lesson = Lesson::find($lessonId);
        $moduleId = $lesson ? $lesson->module_id : null;

        $filePath = storage_path('app/public/' . $documentPath);
        $fileSize = file_exists($filePath) ? filesize($filePath) : null;
        $fileType = pathinfo($documentPath, PATHINFO_EXTENSION);

        $download = DocumentDownload::create([
            'user_id' => $userId,
            'lesson_id' => $lessonId,
            'document_name' => $documentName,
            'document_path' => $documentPath,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'downloaded_at' => now(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        $lessonActivity = LessonUserActivity::where('user_id', $userId)
            ->where('lesson_id', $lessonId)
            ->first();

        if ($lessonActivity) {
            $downloads = $lessonActivity->document_downloads ?? [];
            if (!in_array($documentName, $downloads)) {
                $downloads[] = $documentName;
                $lessonActivity->document_downloads = $downloads;
                $lessonActivity->save();
            }
        }

        AuditTrail::logActivity(
            $userId,
            'document_downloaded',
            'Document',
            "Downloaded document: {$documentName} (Lesson ID: {$lessonId})",
            [
                'resource_id' => $lessonId,
                'resource_type' => 'lesson',
                'module_id' => $moduleId,
                'document_name' => $documentName,
                'document_path' => $documentPath,
                'file_size' => $fileSize
            ]
        );

        return $download;
    }

    /**
     * Track quiz start
     */
    public function trackQuizStart($userId, $moduleId, $lessonId, $quizId = null)
    {
        $attempt = AttemptAnswer::create([
            'user_id' => $userId,
            'module_id' => $moduleId,
            'lesson_id' => $lessonId,
            'quiz_id' => $quizId,
            'attempt_started_at' => now(),
            'attempt_status' => 'started'
        ]);

        AuditTrail::logActivity(
            $userId,
            'quiz_started',
            'Quiz',
            "Started quiz attempt (Lesson ID: {$lessonId})",
            [
                'resource_id' => $lessonId,
                'resource_type' => 'quiz',
                'module_id' => $moduleId,
                'attempt_id' => $attempt->id
            ]
        );

        return $attempt;
    }

    /**
     * Track quiz completion
     */
    public function trackQuizCompletion($attemptId, $answers, $userId, $moduleId, $lessonId)
    {
        $attempt = AttemptAnswer::find($attemptId);
        if (!$attempt) {
            return null;
        }

        $score = $this->calculateQuizScore($attempt, $answers);

        AuditTrail::logActivity(
            $userId,
            'quiz_completed',
            'Quiz',
            "Completed quiz with score: {$score}% (Lesson ID: {$lessonId})",
            [
                'resource_id' => $lessonId,
                'resource_type' => 'quiz',
                'module_id' => $moduleId,
                'attempt_id' => $attempt->id,
                'score_percentage' => $score,
                'progress_percentage' => $score
            ]
        );

        $this->updateModuleProgress($userId, $moduleId);

        return $attempt;
    }

    private function calculateQuizScore($attempt, $answers)
    {
        $totalQuestions = count($answers);
        $correctAnswers = 0;

        foreach ($answers as $quizId => $userAnswer) {
            $quiz = \App\Models\Quizz::find($quizId);
            if ($quiz && $quiz->correct_answer === $userAnswer) {
                $correctAnswers++;
            }
        }

        $attempt->total_questions = $totalQuestions;
        $attempt->correct_answers = $correctAnswers;
        $attempt->score_percentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
        $attempt->detailed_answers = $answers;
        $attempt->attempt_completed_at = now();
        $attempt->attempt_status = 'completed';

        if ($attempt->attempt_started_at) {
            $attempt->time_taken_seconds = $attempt->attempt_completed_at->diffInSeconds($attempt->attempt_started_at);
        }

        $attempt->save();

        return $attempt->score_percentage;
    }

    private function updateModuleProgress($userId, $moduleId)
    {
        $progress = UserModuleProgress::where('user_id', $userId)
            ->where('module_id', $moduleId)
            ->first();

        if (!$progress) {
            return;
        }

        $completedLessons = LessonUserActivity::where('user_id', $userId)
            ->where('module_id', $moduleId)
            ->where('lesson_completed', true)
            ->count();

        $completedQuizzes = AttemptAnswer::where('user_id', $userId)
            ->where('module_id', $moduleId)
            ->where('attempt_status', 'completed')
            ->where('score_percentage', '>=', 70)
            ->distinct('lesson_id')
            ->count();

        $progress->completed_lessons = $completedLessons;
        $progress->completed_quizzes = $completedQuizzes;
        $progress->calculateProgress();
    }

    public function getUserActivityReport($userId, $moduleId = null, $dateFrom = null, $dateTo = null)
    {
        $query = AuditTrail::where('user_id', $userId)
            ->orderBy('activity_timestamp', 'desc');

        if ($moduleId) {
            $query->where(function($q) use ($moduleId) {
                $q->where('activity_data->module_id', $moduleId)
                  ->orWhere('resource_id', $moduleId);
            });
        }

        if ($dateFrom) {
            $query->where('activity_timestamp', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('activity_timestamp', '<=', $dateTo);
        }

        return $query->with('user')->get();
    }

    public function getUserProgressSummary($userId)
    {
        return [
            'module_progress' => UserModuleProgress::where('user_id', $userId)
                ->with('module')
                ->get(),

            'lesson_activities' => LessonUserActivity::where('user_id', $userId)
                ->with(['lesson', 'module'])
                ->get(),

            'quiz_attempts' => AttemptAnswer::where('user_id', $userId)
                ->where('attempt_status', 'completed')
                ->with(['lesson', 'module'])
                ->orderBy('attempt_completed_at', 'desc')
                ->get(),

            'document_downloads' => DocumentDownload::where('user_id', $userId)
                ->with('lesson')
                ->orderBy('downloaded_at', 'desc')
                ->get(),

            'recent_activities' => AuditTrail::where('user_id', $userId)
                ->orderBy('activity_timestamp', 'desc')
                ->limit(50)
                ->get()
        ];
    }
}
