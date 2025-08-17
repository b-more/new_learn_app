<?php
// app/Traits/TrackableActivity.php

namespace App\Traits;

use App\Services\ActivityTrackingService;

trait TrackableActivity
{
    protected function trackActivity($actionType, $module = null, $activity = null, $data = [])
    {
        $activityService = app(ActivityTrackingService::class);

        $userId = auth()->id() ?? $this->id ?? null;

        if ($userId) {
            return $activityService->trackActivity($userId, $actionType, $module, $activity, $data);
        }

        return null;
    }
}
