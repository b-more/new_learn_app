<?php

namespace App\Filament\Resources\UserActivityResource\Widgets;

use App\Models\AuditTrail;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActivityStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalActivities = AuditTrail::count();
        $todayActivities = AuditTrail::whereDate('activity_timestamp', today())->count();
        $weekActivities = AuditTrail::whereBetween('activity_timestamp', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        $uniqueUsers = AuditTrail::distinct('user_id')->count();

        // Calculate trends
        $yesterdayActivities = AuditTrail::whereDate('activity_timestamp', now()->yesterday())->count();
        $todayTrend = $yesterdayActivities > 0
            ? round((($todayActivities - $yesterdayActivities) / $yesterdayActivities) * 100, 1)
            : ($todayActivities > 0 ? 100 : 0);

        $lastWeekActivities = AuditTrail::whereBetween('activity_timestamp', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek()
        ])->count();
        $weekTrend = $lastWeekActivities > 0
            ? round((($weekActivities - $lastWeekActivities) / $lastWeekActivities) * 100, 1)
            : ($weekActivities > 0 ? 100 : 0);

        return [
            Stat::make('Total Activities', number_format($totalActivities))
                ->description('All time activities')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary'),

            Stat::make('Today\'s Activities', number_format($todayActivities))
                ->description($todayTrend >= 0 ? "+{$todayTrend}% from yesterday" : "{$todayTrend}% from yesterday")
                ->descriptionIcon($todayTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($todayTrend >= 0 ? 'success' : 'danger'),

            Stat::make('This Week', number_format($weekActivities))
                ->description($weekTrend >= 0 ? "+{$weekTrend}% from last week" : "{$weekTrend}% from last week")
                ->descriptionIcon($weekTrend >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($weekTrend >= 0 ? 'success' : 'danger'),

            Stat::make('Active Users', number_format($uniqueUsers))
                ->description('Users with activities')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
