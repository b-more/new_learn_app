<?php

// app/Filament/Resources/UserProgressResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\UserProgressResource\Pages;
use App\Models\UserModuleProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Support\Enums\FontWeight;

class UserProgressResource extends Resource
{
    protected static ?string $model = UserModuleProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationLabel = 'User Progress';

    protected static ?string $modelLabel = 'User Progress';

    protected static ?string $pluralModelLabel = 'User Progress Reports';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('module_id')
                    ->relationship('module', 'title')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'assigned' => 'Assigned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('overall_progress')
                    ->numeric()
                    ->suffix('%'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold),

                Tables\Columns\TextColumn::make('module.title')
                    ->label('Module')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'secondary' => 'assigned',
                        'warning' => 'in_progress',
                        'success' => 'completed',
                    ])
                    ->icons([
                        'assigned' => 'heroicon-o-clock',
                        'in_progress' => 'heroicon-o-play',
                        'completed' => 'heroicon-o-check-circle',
                    ]),

                // Fixed: Replace ProgressColumn with TextColumn
                Tables\Columns\TextColumn::make('overall_progress')
                    ->label('Progress')
                    ->formatStateUsing(fn ($record) =>
                        '<div class="flex items-center space-x-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: ' . $record->overall_progress . '%"></div>
                            </div>
                            <span class="text-sm font-medium">' . number_format($record->overall_progress, 1) . '%</span>
                         </div>'
                    )
                    ->html()
                    ->sortable(),

                Tables\Columns\TextColumn::make('completed_lessons')
                    ->label('Lessons')
                    ->formatStateUsing(fn ($record) =>
                        $record->completed_lessons . '/' . $record->total_lessons
                    ),

                Tables\Columns\TextColumn::make('completed_quizzes')
                    ->label('Quizzes')
                    ->formatStateUsing(fn ($record) =>
                        $record->completed_quizzes . '/' . $record->total_quizzes
                    ),

                Tables\Columns\TextColumn::make('assigned_at')
                    ->label('Assigned')
                    ->dateTime('M j, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('first_accessed_at')
                    ->label('First Access')
                    ->dateTime('M j, Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_accessed_at')
                    ->label('Last Access')
                    ->dateTime('M j, Y H:i')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->label('User'),

                SelectFilter::make('module_id')
                    ->relationship('module', 'title')
                    ->searchable()
                    ->preload()
                    ->label('Module'),

                SelectFilter::make('status')
                    ->options([
                        'assigned' => 'Assigned',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('last_accessed_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserProgress::route('/'),
            'create' => Pages\CreateUserProgress::route('/create'),
            'view' => Pages\ViewUserProgress::route('/{record}'),
            'edit' => Pages\EditUserProgress::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'in_progress')->count();
    }

    public static function canCreate(): bool
    {
        return false; // Progress is auto-managed
    }
}
