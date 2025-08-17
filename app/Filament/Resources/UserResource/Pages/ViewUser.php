<?php

// FILE: app/Filament/Resources/UserResource/Pages/ViewUser.php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use App\Models\AttemptAnswer;
use App\Models\UserModuleProgress;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EDIT ACTION
            Actions\EditAction::make()
                ->icon('heroicon-o-pencil-square')
                ->color('warning'),

            // MAIN DASHBOARD ACTION
            Action::make('viewDashboard')
                ->label('Performance Dashboard')
                ->icon('heroicon-o-chart-bar')
                ->color('success')
                ->size('lg')
                ->url(fn (): string => route('admin.user-dashboard', ['userId' => $this->record->id]))
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->modules()->count() > 0)
                ->tooltip('Open comprehensive performance analytics dashboard'),

            // PDF DOWNLOAD ACTION
            Action::make('downloadPDF')
                ->label('Download Report')
                ->icon('heroicon-o-document-arrow-down')
                ->color('info')
                ->url(fn (): string => route('admin.user-dashboard.pdf', ['userId' => $this->record->id]))
                ->openUrlInNewTab()
                ->visible(fn () => $this->record->modules()->count() > 0)
                ->tooltip('Download detailed performance report as PDF'),

            // QUICK STATS ACTION
            Action::make('quickStats')
                ->label('Quick Stats')
                ->icon('heroicon-o-information-circle')
                ->color('gray')
                ->modalHeading('Quick Performance Statistics')
                ->modalDescription('Overview of user performance and activity')
                ->modalContent(function () {
                    $userId = $this->record->id;

                    // Get quiz statistics
                    $totalSessions = AttemptAnswer::where('user_id', $userId)
                        ->whereNotNull('session_id')
                        ->where('session_status', 'completed')
                        ->distinct('session_id')
                        ->count();

                    $totalAttempts = AttemptAnswer::where('user_id', $userId)->count();

                    $averageScore = AttemptAnswer::where('user_id', $userId)
                        ->where('auto_mark', true)
                        ->count();
                    $totalQuestions = AttemptAnswer::where('user_id', $userId)->count();
                    $avgPercentage = $totalQuestions > 0 ? round(($averageScore / $totalQuestions) * 100, 1) : 0;

                    // Get module progress
                    $totalModules = $this->record->modules()->count();
                    $completedModules = UserModuleProgress::where('user_id', $userId)
                        ->where('status', 'completed')
                        ->count();
                    $moduleProgress = $totalModules > 0 ? round(($completedModules / $totalModules) * 100, 1) : 0;

                    // Get last activity
                    $lastActivity = \App\Models\AuditTrail::where('user_id', $userId)
                        ->orderBy('activity_timestamp', 'desc')
                        ->first();

                    return view('filament.user.quick-stats', [
                        'user' => $this->record,
                        'totalSessions' => $totalSessions,
                        'totalAttempts' => $totalAttempts,
                        'avgPercentage' => $avgPercentage,
                        'totalModules' => $totalModules,
                        'completedModules' => $completedModules,
                        'moduleProgress' => $moduleProgress,
                        'lastActivity' => $lastActivity?->activity_timestamp?->diffForHumans() ?? 'No activity'
                    ]);
                })
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Close')
                ->visible(fn () => $this->record->modules()->count() > 0),

            // ASSIGN MODULES ACTION
            Action::make('assignModules')
                ->label('Assign Modules')
                ->icon('heroicon-o-book-open')
                ->color('primary')
                ->form([
                    \Filament\Forms\Components\Select::make('modules')
                        ->label('Select Modules')
                        ->multiple()
                        ->preload()
                        ->options(function () {
                            // Only show modules not already assigned
                            $assignedModuleIds = $this->record->modules()->pluck('id')->toArray();
                            return \App\Models\Module::whereNotIn('id', $assignedModuleIds)
                                ->pluck('title', 'id');
                        })
                        ->required()
                        ->helperText('Select one or more modules to assign to this user'),
                ])
                ->action(function (array $data): void {
                    try {
                        // Assign modules
                        $this->record->modules()->attach($data['modules']);

                        // Create progress records
                        foreach ($data['modules'] as $moduleId) {
                            $module = \App\Models\Module::find($moduleId);
                            if ($module) {
                                $totalLessons = $module->lessons()->count();
                                $totalQuizzes = \DB::table('quizzs')
                                    ->whereIn('lesson_id', $module->lessons()->pluck('id'))
                                    ->count();

                                UserModuleProgress::updateOrCreate(
                                    ['user_id' => $this->record->id, 'module_id' => $moduleId],
                                    [
                                        'assigned_at' => now(),
                                        'total_lessons' => $totalLessons,
                                        'total_quizzes' => $totalQuizzes,
                                        'overall_progress' => 0,
                                        'status' => 'assigned'
                                    ]
                                );
                            }
                        }

                        // Log activity
                        foreach ($data['modules'] as $moduleId) {
                            \App\Models\AuditTrail::create([
                                'user_id' => auth()->id(),
                                'action_type' => 'module_assigned',
                                'module' => 'Module Assignment',
                                'activity_description' => "Assigned module to user: {$this->record->name}",
                                'activity_timestamp' => now(),
                                'additional_data' => json_encode([
                                    'resource_id' => $moduleId,
                                    'resource_type' => 'module',
                                    'target_user_id' => $this->record->id
                                ])
                            ]);
                        }

                        \Filament\Notifications\Notification::make()
                            ->title('Modules Assigned Successfully')
                            ->body(count($data['modules']) . ' modules have been assigned to ' . $this->record->name)
                            ->success()
                            ->send();

                        // Refresh the page to show updated data
                        $this->redirect(request()->url());

                    } catch (\Exception $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Assignment Failed')
                            ->body('Error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                })
                ->modalHeading('Assign Modules')
                ->modalDescription('Assign new learning modules to this user')
                ->modalSubmitActionLabel('Assign Modules'),
        ];
    }

    /**
     * Get the breadcrumb for this page
     * FIXED: Changed from protected to public
     */
    public function getBreadcrumbs(): array
    {
        return [
            '/admin/users' => 'Users',
            '' => $this->record->name,
        ];
    }

    /**
     * Get the heading for this page
     * FIXED: Changed from protected to public
     */
    public function getHeading(): string
    {
        return $this->record->name;
    }

    /**
     * Get the subheading for this page
     * FIXED: Changed from protected to public
     */
    public function getSubheading(): ?string
    {
        $moduleCount = $this->record->modules()->count();
        $role = $this->record->role->name ?? 'No role assigned';

        return "{$role} • {$moduleCount} modules assigned • Member since " . $this->record->created_at->format('M Y');
    }
}
