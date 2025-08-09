<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Module;
use App\Models\UserModuleProgress;

class AssignedModules extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.assigned-modules';

    protected static ?int $navigationSort = 1;

    public function getSubheading(): string
    {
        return "Anti-Money Laundering | Transaction Monitoring | KYC Scanning [User Training]";
    }

    /**
     * Get user's modules with progress data for the view
     */
    public function getUserModulesWithProgress()
    {
        $user = auth()->user();
        $modules = $user->modules()->with('lessons')->get();

        $moduleProgress = UserModuleProgress::where('user_id', $user->id)
            ->get()
            ->keyBy('module_id');

        return $modules->map(function ($module) use ($moduleProgress) {
            $progress = $moduleProgress->get($module->id);

            return [
                'id' => $module->id,
                'title' => $module->title,
                'description' => $module->description,
                'icon' => $module->icon,
                'total_lessons' => $module->lessons->count(),
                'progress' => $progress ? [
                    'overall_progress' => $progress->overall_progress ?? 0,
                    'completed_lessons' => $progress->completed_lessons ?? 0,
                    'status' => $progress->status ?? 'assigned'
                ] : [
                    'overall_progress' => 0,
                    'completed_lessons' => 0,
                    'status' => 'assigned'
                ]
            ];
        });
    }

    /**
     * Get summary statistics for the user's modules
     */
    public function getModuleStats()
    {
        $user = auth()->user();
        $totalModules = $user->modules()->count();

        $progress = UserModuleProgress::where('user_id', $user->id)->get();

        $completed = $progress->where('status', 'completed')->count();
        $inProgress = $progress->where('status', 'in_progress')->count();
        $notStarted = $totalModules - $completed - $inProgress;

        return [
            'total' => $totalModules,
            'completed' => $completed,
            'in_progress' => $inProgress,
            'not_started' => $notStarted,
            'completion_rate' => $totalModules > 0 ? round(($completed / $totalModules) * 100, 1) : 0
        ];
    }
}
