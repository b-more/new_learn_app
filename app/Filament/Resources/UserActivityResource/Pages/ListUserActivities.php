<?php

namespace App\Filament\Resources\UserActivityResource\Pages;

use App\Filament\Resources\UserActivityResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use App\Models\AuditTrail;
use Barryvdh\DomPDF\Facade\Pdf;

class ListUserActivities extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = UserActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_all_activities')
                ->label('Export All Activities')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action('exportAllActivities'),

            Action::make('export_summary_report')
                ->label('Export Summary Report')
                ->icon('heroicon-o-chart-bar')
                ->color('primary')
                ->action('exportSummaryReport'),
        ];
    }

    public function exportAllActivities()
    {
        $activities = AuditTrail::with('user')
            ->orderBy('activity_timestamp', 'desc')
            ->get();

        $pdf = Pdf::loadView('filament.exports.activities-pdf', [
            'activities' => $activities,
            'totalActivities' => $activities->count(),
            'exportDate' => now()->format('M j, Y H:i:s'),
            'dateRange' => [
                'from' => $activities->min('activity_timestamp')?->format('M j, Y'),
                'to' => $activities->max('activity_timestamp')?->format('M j, Y')
            ]
        ]);

        $filename = 'all-user-activities-' . now()->format('Y-m-d-H-i-s') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function exportSummaryReport()
    {
        $activities = AuditTrail::with('user')->get();

        $summary = [
            'total_activities' => $activities->count(),
            'unique_users' => $activities->unique('user_id')->count(),
            'activity_types' => $activities->groupBy('action_type')->map->count(),
            'daily_activities' => $activities->groupBy(function($item) {
                return $item->activity_timestamp->format('Y-m-d');
            })->map->count(),
            'module_activities' => $activities->whereNotNull('module')->groupBy('module')->map->count(),
            'top_users' => $activities->groupBy('user.name')->map->count()->sortDesc()->take(10),
            'recent_activities' => $activities->sortByDesc('activity_timestamp')->take(20)
        ];

        $pdf = Pdf::loadView('filament.exports.activity-summary-report', [
            'summary' => $summary,
            'exportDate' => now()->format('M j, Y H:i:s')
        ]);

        $filename = 'activity-summary-report-' . now()->format('Y-m-d-H-i-s') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserActivityResource\Widgets\ActivityStatsWidget::class,
        ];
    }
}
