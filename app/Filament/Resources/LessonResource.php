<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Models\Lesson;
use App\Models\Module;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadLessonPermission();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Main Lesson Details Section
                Forms\Components\Section::make('Lesson Details')
                    ->schema([
                        Forms\Components\Select::make('module_id')
                            ->options(Module::all()->pluck('title', 'id')->toArray())
                            ->required()
                            ->label('Module Name')
                            ->searchable(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->label('Lesson Title')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->label('Lesson Description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('video_length')
                            ->label('Video Length')
                            ->placeholder('e.g., 10:30'),

                        Forms\Components\TextInput::make('order')
                            ->label('Lesson Order')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                    ])
                    ->columns(2),

                // Media Upload Section
                Forms\Components\Section::make('Media & Documents')
                    ->schema([
                        Forms\Components\FileUpload::make('video_thumbnail')
                            ->label('Lesson Thumbnail/Poster')
                            ->directory('thumbnail')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp', 'image/bmp'])
                            ->required()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['5:4'])
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('video_url')
                            ->label('Video')
                            ->directory('lessons')
                            ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mpeg', 'video/quicktime'])
                            ->maxSize(102400) // 100MB in kilobytes
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('documents')
                            ->label('Lesson Documents')
                            ->directory('lessons/documents')
                            ->multiple()
                            ->preserveFilenames()
                            ->acceptedFileTypes(['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'xlsx', 'xls'])
                            ->columnSpanFull(),
                    ]),

                // Quiz Timer Settings Section
                Forms\Components\Section::make('Quiz Timer Settings')
                    ->description('Configure timer settings for quizzes in this lesson')
                    ->schema([
                        Forms\Components\Toggle::make('quiz_timer_enabled')
                            ->label('Enable Quiz Timer')
                            ->default(true)
                            ->live()
                            ->helperText('Enable or disable timer for all quizzes in this lesson'),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('quiz_timer_minutes')
                                    ->label('Quiz Duration (Minutes)')
                                    ->numeric()
                                    ->default(30)
                                    ->minValue(1)
                                    ->maxValue(300)
                                    ->required()
                                    ->visible(fn (Forms\Get $get) => $get('quiz_timer_enabled'))
                                    ->helperText('Total time allowed for completing all quiz questions'),

                                Forms\Components\Toggle::make('auto_submit_on_timeout')
                                    ->label('Auto-submit on Timeout')
                                    ->default(true)
                                    ->visible(fn (Forms\Get $get) => $get('quiz_timer_enabled'))
                                    ->helperText('Automatically submit quiz when time expires'),
                            ]),

                        Forms\Components\Fieldset::make('Warning Settings')
                            ->schema([
                                Forms\Components\Toggle::make('show_timer_warning')
                                    ->label('Show Time Warning')
                                    ->default(true)
                                    ->live()
                                    ->visible(fn (Forms\Get $get) => $get('quiz_timer_enabled'))
                                    ->helperText('Show warning when time is running low'),

                                Forms\Components\TextInput::make('warning_time_minutes')
                                    ->label('Warning Time (Minutes)')
                                    ->numeric()
                                    ->default(5)
                                    ->minValue(1)
                                    ->maxValue(60)
                                    ->visible(fn (Forms\Get $get) => $get('quiz_timer_enabled') && $get('show_timer_warning'))
                                    ->helperText('Show warning when this many minutes remain'),
                            ])
                            ->visible(fn (Forms\Get $get) => $get('quiz_timer_enabled')),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module_id')
                    ->formatStateUsing(function ($record) {
                        return Module::where('id', $record->module_id)->first()->title ?? "";
                    })
                    ->label('Module')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Lesson Title')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable(),

                // Display video URL as a link or file name
                Tables\Columns\TextColumn::make('video_url')
                    ->label('Video')
                    ->formatStateUsing(function ($record) {
                        return $record->video_url ? basename($record->video_url) : 'No Video';
                    })
                    ->url(function ($record) {
                        return $record->video_url ? asset('storage/' . $record->video_url) : null;
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('video_length')
                    ->searchable()
                    ->label('Video Length'),

                // Display video thumbnail as an image
                Tables\Columns\ImageColumn::make('video_thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->visible(fn($record) => $record->video_thumbnail ?? ""),

                // Timer settings columns
                Tables\Columns\IconColumn::make('quiz_timer_enabled')
                    ->label('Timer')
                    ->boolean()
                    ->tooltip('Quiz timer enabled'),

                Tables\Columns\TextColumn::make('quiz_timer_minutes')
                    ->label('Timer Duration')
                    ->formatStateUsing(function ($state, $record) {
                        if (!$record->quiz_timer_enabled) {
                            return 'No limit';
                        }
                        $minutes = $record->quiz_timer_minutes;
                        if ($minutes < 60) {
                            return "{$minutes} min";
                        } else {
                            $hours = floor($minutes / 60);
                            $remainingMinutes = $minutes % 60;
                            return $remainingMinutes > 0 ? "{$hours}h {$remainingMinutes}m" : "{$hours}h";
                        }
                    })
                    ->badge()
                    ->color(fn ($record) => $record->quiz_timer_enabled ? 'success' : 'gray'),

                // Quiz count (if you want to show quiz count)
                Tables\Columns\TextColumn::make('quizzes_count')
                    ->label('Quiz Questions')
                    ->formatStateUsing(function ($record) {
                        return \App\Models\Quizz::where('lesson_id', $record->id)->count();
                    })
                    ->badge()
                    ->color('primary'),

                // Display documents as download links
                Tables\Columns\TextColumn::make('documents')
                    ->label('Documents')
                    ->formatStateUsing(function ($record) {
                        if ($record->documents) {
                            $documents = is_string($record->documents) ? json_decode($record->documents, true) : $record->documents;
                            if (is_array($documents)) {
                                return collect($documents)->map(function ($document) {
                                    return "<a href='" . asset('storage/' . $document) . "' download>" . basename($document) . "</a>";
                                })->implode(', ');
                            }
                        }
                        return 'No Documents';
                    })
                    ->html()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('module_id')
                    ->label('Module')
                    ->options(Module::all()->pluck('title', 'id')->toArray()),

                Tables\Filters\TernaryFilter::make('quiz_timer_enabled')
                    ->label('Timer Enabled'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->successRedirectUrl('lessons'),

                // Timer Preview Action (optional - remove if you don't want it)
                Tables\Actions\Action::make('timer_info')
                    ->label('Timer Info')
                    ->icon('heroicon-o-clock')
                    ->color('info')
                    ->action(function ($record) {
                        // You can add a notification or modal here
                        if ($record->quiz_timer_enabled) {
                            $duration = $record->quiz_timer_minutes;
                            $warning = $record->show_timer_warning ? "Warning at {$record->warning_time_minutes} min" : "No warning";
                            $autoSubmit = $record->auto_submit_on_timeout ? "Auto-submit enabled" : "Manual submit only";

                            \Filament\Notifications\Notification::make()
                                ->title('Quiz Timer Settings')
                                ->body("Duration: {$duration} minutes<br>{$warning}<br>{$autoSubmit}")
                                ->info()
                                ->send();
                        } else {
                            \Filament\Notifications\Notification::make()
                                ->title('Timer Disabled')
                                ->body('No time limit for this lesson\'s quizzes')
                                ->info()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
