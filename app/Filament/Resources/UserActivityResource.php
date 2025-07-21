<?php

namespace App\Filament\Resources;

use App\Models\AuditTrail;
use App\Models\User;
use App\Models\Module;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;

class UserActivityResource extends Resource
{
    protected static ?string $model = AuditTrail::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Analytics';

    protected static ?string $navigationLabel = 'User Activities';

    protected static ?string $modelLabel = 'User Activity';

    protected static ?string $pluralModelLabel = 'User Activities';

    protected static ?int $navigationSort = 1;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                Tables\Columns\BadgeColumn::make('action_type')
                    ->label('Action')
                    ->colors([
                        'success' => ['module_accessed', 'lesson_accessed', 'quiz_completed'],
                        'warning' => ['quiz_attempt_started', 'quiz_accessed'],
                        'danger' => ['quiz_error'],
                        'primary' => ['progress_updated'],
                        'secondary' => ['quiz_question_answered'],
                    ])
                    ->icons([
                        'heroicon-o-academic-cap' => 'module_accessed',
                        'heroicon-o-book-open' => 'lesson_accessed',
                        'heroicon-o-clipboard-document-check' => 'quiz_completed',
                        'heroicon-o-play' => 'quiz_attempt_started',
                        'heroicon-o-chart-bar' => 'progress_updated',
                        'heroicon-o-exclamation-triangle' => 'quiz_error',
                    ])
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('module')
                    ->label('Module')
                    ->searchable()
                    ->sortable()
                    ->color('secondary'),

                Tables\Columns\TextColumn::make('activity')
                    ->label('Activity Description')
                    ->searchable()
                    ->limit(60)
                    ->tooltip(function ($record) {
                        return $record->activity;
                    }),

                Tables\Columns\TextColumn::make('progress_percentage')
                    ->label('Progress %')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return $state ? $state . '%' : '-';
                    })
                    ->color(function ($state) {
                        if (!$state) return 'gray';
                        if ($state >= 70) return 'success';
                        if ($state >= 50) return 'warning';
                        return 'danger';
                    }),

                Tables\Columns\TextColumn::make('resource_type')
                    ->label('Resource')
                    ->badge()
                    ->colors([
                        'primary' => 'module',
                        'success' => 'lesson',
                        'warning' => 'quiz',
                        'info' => 'quiz_question',
                    ])
                    ->searchable(),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('activity_timestamp')
                    ->label('Date & Time')
                    ->dateTime('M j, Y H:i:s')
                    ->sortable()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('time_ago')
                    ->label('Time Ago')
                    ->state(function ($record) {
                        return $record->activity_timestamp ? $record->activity_timestamp->diffForHumans() : '-';
                    })
                    ->color('gray')
                    ->size('sm'),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('action_type')
                    ->label('Action Type')
                    ->options([
                        'module_accessed' => 'Module Accessed',
                        'lesson_accessed' => 'Lesson Accessed',
                        'quiz_accessed' => 'Quiz Accessed',
                        'quiz_attempt_started' => 'Quiz Attempt Started',
                        'quiz_completed' => 'Quiz Completed',
                        'quiz_question_answered' => 'Question Answered',
                        'progress_updated' => 'Progress Updated',
                        'quiz_error' => 'Quiz Error',
                    ])
                    ->multiple(),

                SelectFilter::make('resource_type')
                    ->label('Resource Type')
                    ->options([
                        'module' => 'Module',
                        'lesson' => 'Lesson',
                        'quiz' => 'Quiz',
                        'quiz_question' => 'Quiz Question',
                    ])
                    ->multiple(),

                SelectFilter::make('module')
                    ->label('Module')
                    ->options(function () {
                        return Module::pluck('title', 'title')->toArray();
                    })
                    ->searchable(),

                Filter::make('progress_range')
                    ->form([
                        Select::make('progress_operator')
                            ->label('Progress')
                            ->options([
                                'gte' => 'Greater than or equal to',
                                'lte' => 'Less than or equal to',
                                'eq' => 'Equal to',
                            ])
                            ->default('gte'),
                        Select::make('progress_value')
                            ->label('Percentage')
                            ->options([
                                '0' => '0%',
                                '25' => '25%',
                                '50' => '50%',
                                '70' => '70%',
                                '75' => '75%',
                                '100' => '100%',
                            ])
                            ->default('70'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['progress_operator'] && $data['progress_value'],
                            function (Builder $query) use ($data) {
                                $operator = match($data['progress_operator']) {
                                    'gte' => '>=',
                                    'lte' => '<=',
                                    'eq' => '=',
                                    default => '>='
                                };
                                return $query->where('progress_percentage', $operator, $data['progress_value']);
                            }
                        );
                    }),

                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from_date')
                            ->label('From Date'),
                        DatePicker::make('to_date')
                            ->label('To Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('activity_timestamp', '>=', $date),
                            )
                            ->when(
                                $data['to_date'],
                                fn (Builder $query, $date): Builder => $query->whereDate('activity_timestamp', '<=', $date),
                            );
                    }),

                Filter::make('today')
                    ->query(fn (Builder $query): Builder => $query->whereDate('activity_timestamp', today()))
                    ->toggle(),

                Filter::make('this_week')
                    ->query(fn (Builder $query): Builder => $query->whereBetween('activity_timestamp', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]))
                    ->toggle(),

                Filter::make('passing_scores')
                    ->label('Passing Scores Only (≥70%)')
                    ->query(fn (Builder $query): Builder => $query->where('progress_percentage', '>=', 70))
                    ->toggle(),
            ])
            ->actions([
                Action::make('view_details')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading('Activity Details')
                    ->modalContent(function ($record) {
                        return view('filament.modals.activity-details', ['record' => $record]);
                    })
                    ->modalWidth('4xl'),

                Action::make('export_single_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($record) {
                        return static::exportSingleActivityPdf($record);
                    }),
            ])
            ->bulkActions([
                BulkAction::make('export_pdf')
                    ->label('Export Selected to PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function (Collection $records) {
                        return static::exportActivitiesPdf($records);
                    }),

                BulkAction::make('export_all_pdf')
                    ->label('Export All (Filtered) to PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('primary')
                    ->action(function (Collection $records) {
                        // Get all records based on current filters
                        $query = static::getEloquentQuery();
                        $allRecords = $query->with('user')->orderBy('activity_timestamp', 'desc')->get();
                        return static::exportActivitiesPdf($allRecords);
                    }),
            ])
            ->defaultSort('activity_timestamp', 'desc')
            ->poll('30s') // Auto-refresh every 30 seconds
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }

    public static function exportSingleActivityPdf($record)
    {
        $pdf = Pdf::loadView('filament.exports.single-activity-pdf', [
            'activity' => $record,
            'exportDate' => now()->format('M j, Y H:i:s')
        ]);

        $filename = 'activity-' . $record->id . '-' . now()->format('Y-m-d-H-i-s') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public static function exportActivitiesPdf(Collection $records)
    {
        // Group activities by user for better organization
        $groupedActivities = $records->groupBy('user.name');

        $pdf = Pdf::loadView('filament.exports.activities-pdf', [
            'activities' => $records,
            'groupedActivities' => $groupedActivities,
            'totalActivities' => $records->count(),
            'exportDate' => now()->format('M j, Y H:i:s'),
            'dateRange' => [
                'from' => $records->min('activity_timestamp')?->format('M j, Y'),
                'to' => $records->max('activity_timestamp')?->format('M j, Y')
            ]
        ]);

        $filename = 'user-activities-' . now()->format('Y-m-d-H-i-s') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\UserActivityResource\Pages\ListUserActivities::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('activity_timestamp', '>=', now()->subDay())->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getNavigationBadge();
        if ($count > 100) return 'danger';
        if ($count > 50) return 'warning';
        return 'success';
    }
}
