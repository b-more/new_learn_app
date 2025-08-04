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
        $total_attempts = AttemptAnswer::where('user_id', $user->id)->count();

        if ($total_attempts > 0) {
            $success_count = AttemptAnswer::where('user_id', $user->id)->where('auto_mark', 1)->count();
            $total_success = number_format(($success_count / $total_attempts) * 100, 1) . "%";
        } else {
            $total_success = "0%";
        }

        return [
            Stat::make('Assigned Modules', $total_assigned_modules)
                ->color('success'),
            Stat::make('Quiz Attempts', $total_attempts)
                ->color('info'),
            Stat::make('Success Rate', $total_success)
                ->color('success'),
            Stat::make('Completion', '100%')
                ->color('warning'),
        ];
    }
}
