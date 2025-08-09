<?php

namespace App\Livewire;

use App\Models\AttemptAnswer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QuizzStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Use simple counts that work with your current model
        $totalAttempts = AttemptAnswer::count();
        $totalSuccess = AttemptAnswer::where('auto_mark', 1)->count();
        $totalFails = AttemptAnswer::where('auto_mark', 0)->count();

        return [
            Stat::make('Total Attempts', $totalAttempts),
            Stat::make('Total Success', $totalSuccess),
            Stat::make('Total Fails', $totalFails),
        ];
    }
}
