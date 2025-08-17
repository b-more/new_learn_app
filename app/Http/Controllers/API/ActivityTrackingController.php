<?php
// app/Http/Controllers/API/ActivityTrackingController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ActivityTrackingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ActivityTrackingController extends Controller
{
    protected $activityService;

    public function __construct(ActivityTrackingService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function track(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userId = $request->user_id;
            $action = $request->action;

            switch ($action) {
                case 'module_access':
                    $moduleId = $request->module_id;
                    $this->activityService->trackModuleAccess($userId, $moduleId);
                    break;

                case 'lesson_access':
                    $lessonId = $request->lesson_id;
                    $moduleId = $request->module_id;
                    $this->activityService->trackLessonAccess($userId, $lessonId, $moduleId);
                    break;

                case 'video_event':
                    $this->handleVideoEvent($request, $userId);
                    break;

                case 'document_download':
                    $this->handleDocumentDownload($request, $userId);
                    break;

                case 'quiz_start':
                    $lessonId = $request->lesson_id;
                    $moduleId = $request->module_id;
                    $quizId = $request->quiz_id ?? null;
                    $attempt = $this->activityService->trackQuizStart($userId, $moduleId, $lessonId, $quizId);

                    return response()->json([
                        'success' => true,
                        'message' => 'Quiz started tracked',
                        'attempt_id' => $attempt->id
                    ]);

                case 'quiz_submission':
                    $this->handleQuizSubmission($request, $userId);
                    break;

                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Unknown action type'
                    ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Activity tracked successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to track activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function handleVideoEvent(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'event_type' => 'required|in:play,pause,progress,completed,seek',
            'lesson_id' => 'required|exists:lessons,id',
            'module_id' => 'required|exists:modules,id',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid video event data');
        }

        $eventType = $request->event_type;
        $lessonId = $request->lesson_id;
        $moduleId = $request->module_id;

        $data = [
            'current_time' => $request->current_time,
            'duration' => $request->duration,
            'progress_percentage' => $request->progress_percentage,
            'watch_time_seconds' => $request->watch_time_seconds,
            'timestamp' => $request->timestamp
        ];

        $this->activityService->trackVideoEvent($userId, $lessonId, $moduleId, $eventType, $data);
    }

    private function handleDocumentDownload(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'document_path' => 'required|string',
            'document_name' => 'required|string',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid document download data');
        }

        $lessonId = $request->lesson_id;
        $documentPath = $request->document_path;
        $documentName = $request->document_name;

        $this->activityService->trackDocumentDownload($userId, $lessonId, $documentPath, $documentName);
    }

    private function handleQuizSubmission(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required|exists:lessons,id',
            'module_id' => 'required|exists:modules,id',
            'answers' => 'required|array',
            'attempt_id' => 'sometimes|exists:attempt_answers,id'
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid quiz submission data');
        }

        $lessonId = $request->lesson_id;
        $moduleId = $request->module_id;
        $answers = $request->answers;
        $attemptId = $request->attempt_id;

        if ($attemptId) {
            $this->activityService->trackQuizCompletion($attemptId, $answers, $userId, $moduleId, $lessonId);
        }
    }

    public function getUserActivity(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'module_id' => 'sometimes|exists:modules,id',
            'date_from' => 'sometimes|date',
            'date_to' => 'sometimes|date|after_or_equal:date_from',
            'limit' => 'sometimes|integer|min:1|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userId = $request->user_id;
            $moduleId = $request->module_id;
            $dateFrom = $request->date_from;
            $dateTo = $request->date_to;

            $activities = $this->activityService->getUserActivityReport($userId, $moduleId, $dateFrom, $dateTo);

            if ($request->limit) {
                $activities = $activities->take($request->limit);
            }

            return response()->json([
                'success' => true,
                'data' => $activities
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get user activity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function assignModule(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userId = $request->user_id;
            $moduleId = $request->module_id;
            $assignedBy = Auth::id();

            $user = \App\Models\User::find($userId);
            $user->modules()->syncWithoutDetaching([$moduleId]);

            $this->activityService->trackModuleAssignment($userId, $moduleId, $assignedBy);

            return response()->json([
                'success' => true,
                'message' => 'Module assigned successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to assign module',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
