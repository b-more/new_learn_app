<?php

namespace App\Livewire;

use App\Models\AttemptAnswer;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QuizzStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_attempts = AttemptAnswer::count();
        $total_success = AttemptAnswer::where('auto_mark',1)->count();
        $total_fail = AttemptAnswer::where('auto_mark',0)->count();

        return [
            Stat::make('Total Attempts', $total_attempts),
            Stat::make('Total Success', $total_success),
            Stat::make('Total Fails', $total_fail),
        ];
    }
}
