<?php
// app/Filament/Resources/LessonResource.php - Updated with improved file upload

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use App\Models\Module;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Notifications\Notification;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Basic Information Section
                Section::make('Lesson Information')
                    ->description('Basic lesson details and content')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('module_id')
                                    ->label('Module')
                                    ->options(Module::all()->pluck('title', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\TextInput::make('order')
                                    ->label('Lesson Order')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->required(),
                            ]),

                        Forms\Components\TextInput::make('title')
                            ->label('Lesson Title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Lesson Description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('video_length')
                            ->label('Video Length')
                            ->placeholder('e.g., 10:30')
                            ->helperText('Format: MM:SS or HH:MM:SS'),
                    ]),

                // Media Upload Section with improved configuration
                Section::make('Media & Documents')
                    ->description('Upload lesson thumbnail, video, and documents')
                    ->schema([
                        Forms\Components\FileUpload::make('video_thumbnail')
                            ->label('Lesson Thumbnail/Poster')
                            ->disk('public')
                            ->directory('thumbnail')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                            ->maxSize(5120) // 5MB
                            ->required()
                            ->helperText('Upload a thumbnail image for this lesson (max 5MB)')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('video_url')
                            ->label('Video File')
                            ->disk('public')
                            ->directory('lessons')
                            ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mpeg', 'video/quicktime', 'video/x-msvideo'])
                            ->maxSize(512000) // 500MB
                            ->helperText('Upload lesson video file (max 500MB). Supported formats: MP4, AVI, MPEG, MOV')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('documents')
    ->label('Lesson Documents')
    ->disk('public')
    ->directory('lessons/documents')
    ->multiple()
    ->reorderable()
    ->preserveFilenames()
    ->acceptedFileTypes([
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    ])
    ->maxSize(51200)
    ->maxFiles(10)
    ->columnSpanFull()
    ->downloadable()
    ->previewable(),
                    ]),

                // Quiz Timer Settings Section
                Section::make('Quiz Timer Settings')
                    ->description('Configure timer settings for quizzes in this lesson')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('quiz_timer_enabled')
                                    ->label('Enable Quiz Timer')
                                    ->default(true)
                                    ->live()
                                    ->helperText('Enable/disable timer for quizzes in this lesson'),

                                Forms\Components\TextInput::make('quiz_timer_minutes')
                                    ->label('Timer Duration (minutes)')
                                    ->numeric()
                                    ->default(30)
                                    ->minValue(1)
                                    ->maxValue(180)
                                    ->visible(fn (Forms\Get $get): bool => $get('quiz_timer_enabled'))
                                    ->helperText('How long users have to complete the quiz'),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Forms\Components\Toggle::make('show_timer_warning')
                                    ->label('Show Timer Warning')
                                    ->default(true)
                                    ->live()
                                    ->visible(fn (Forms\Get $get): bool => $get('quiz_timer_enabled'))
                                    ->helperText('Show warning when time is running out'),

                                Forms\Components\TextInput::make('warning_time_minutes')
                                    ->label('Warning Time (minutes)')
                                    ->numeric()
                                    ->default(5)
                                    ->minValue(1)
                                    ->visible(fn (Forms\Get $get): bool => $get('quiz_timer_enabled') && $get('show_timer_warning'))
                                    ->helperText('Show warning when this many minutes remain'),
                            ]),

                        Forms\Components\Toggle::make('auto_submit_on_timeout')
                            ->label('Auto-submit on Timeout')
                            ->default(true)
                            ->visible(fn (Forms\Get $get): bool => $get('quiz_timer_enabled'))
                            ->helperText('Automatically submit quiz when timer expires')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('video_thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->square()
                    ->size(50),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('module.title')
                    ->label('Module')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('video_length')
                    ->label('Duration')
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('video_url')
                    ->label('Video')
                    ->boolean()
                    ->trueIcon('heroicon-o-play-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('document_count')
                    ->label('Documents')
                    ->alignCenter()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state === 0 => 'gray',
                        $state <= 3 => 'warning',
                        default => 'success',
                    }),

                Tables\Columns\IconColumn::make('quiz_timer_enabled')
                    ->label('Timer')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('module_id')
                    ->label('Module')
                    ->options(Module::all()->pluck('title', 'id'))
                    ->searchable(),

                Tables\Filters\TernaryFilter::make('quiz_timer_enabled')
                    ->label('Timer Enabled'),

                Tables\Filters\Filter::make('has_video')
                    ->label('Has Video')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('video_url')),

                Tables\Filters\Filter::make('has_documents')
                    ->label('Has Documents')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('documents')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
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
            //'view' => Pages\ViewLesson::route('/{record}'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
