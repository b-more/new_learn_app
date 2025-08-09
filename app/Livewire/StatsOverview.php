<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AttemptAnswer;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();

        if (!$user) {
            return [
                Stat::make('Assigned Modules', 0),
                Stat::make('Quiz Attempts', 0),
                Stat::make('Success Rate', '0%'),
                Stat::make('Completion', '0%'),
            ];
        }

        $total_assigned_modules = $user->modules->count();

        // Use your existing getUserStats method with correct array keys
        $userStats = AttemptAnswer::getUserStats($user->id);

        return [
            Stat::make('Assigned Modules', $total_assigned_modules)
                ->color('success'),
            Stat::make('Quiz Attempts', $userStats['total_attempts']) // Fixed: was 'total_sessions'
                ->color('info'),
            Stat::make('Success Rate', $userStats['overall_percentage'] . '%') // Fixed: was 'success_rate'
                ->color('success'),
            Stat::make('Completion', '100%')
                ->color('warning'),
        ];
    }
}
