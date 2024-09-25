<?php

namespace App\Livewire;

use App\Models\AttemptAnswer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_assigned_modules = auth()->user()->modules->count();
        $total_attempts = AttemptAnswer::where('user_id', auth()->user()->id)->count();
        $total_success = AttemptAnswer::where('user_id', auth()->user()->id)->where('auto_mark',1)->count();
        $total_fail = AttemptAnswer::where('user_id', auth()->user()->id)->where('auto_mark',0)->count();

        return [
            Stat::make('Total Assigned Modules', $total_assigned_modules),
            Stat::make('Total Attempts', $total_attempts),
            Stat::make('Total Success', $total_success),
            Stat::make('Total Fails', $total_fail),
        ];
    }
}
