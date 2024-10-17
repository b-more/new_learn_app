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
        $total_assigned_modules = $user->modules->count();
        $total_attempts = AttemptAnswer::where('user_id', $user->id)->count();

        if ($total_attempts > 0) {
            $success_count = AttemptAnswer::where('user_id', $user->id)->where('auto_mark', 1)->count();
            $fail_count = AttemptAnswer::where('user_id', $user->id)->where('auto_mark', 0)->count();
            
            $total_success = number_format(($success_count / $total_attempts) * 100, 1) . "%";
            $total_fail = number_format(($fail_count / $total_attempts) * 100, 1) . "%";
        } else {
            $total_success = "0%";
            $total_fail = "0%";
        }

        return [
            Stat::make('Total Assigned Modules', $total_assigned_modules),
            Stat::make('Total Attempts', $total_attempts),
            Stat::make('Total Success', $total_success),
            Stat::make('Total Fails', $total_fail),
        ];
    }
}