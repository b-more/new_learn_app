<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizzResource\Pages;
use App\Filament\Resources\QuizzResource\RelationManagers;
use App\Models\Lesson;
use App\Models\Quizz;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Grouping\Group;

class QuizzResource extends Resource
{
    protected static ?string $model = Quizz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 3;

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadQuizPermission();
    }

    public static function getNavigationLabel(): string
    {
        return "Quiz";
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Removed 'province_id' from select and groupBy clauses
        return $query->orderBy('updated_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lesson_id')
                    ->label('Lesson')
                    ->required()
                    ->options(Lesson::all()->pluck('title', 'id')->toArray()),
                Forms\Components\Grid::make()
                    ->visible(static fn(Page $livewire): bool => $livewire instanceof Pages\EditQuizz)
                    ->schema([
                        Forms\Components\Textarea::make('question')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('correct_answer')
                            ->options([
                                "A" => "A",
                                "B" => "B",
                                "C" => "C",
                                "D" => "D"
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('answer_option_a')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('answer_option_b')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('answer_option_c')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('answer_option_d')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Repeater::make('questions')
                    ->visible(static fn(Page $livewire): bool => $livewire instanceof Pages\CreateQuizz)
                    ->schema([
                        Forms\Components\Textarea::make('question')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('correct_answer')
                            ->options([
                                "A" => "A",
                                "B" => "B",
                                "C" => "C",
                                "D" => "D"
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('answer_option_a')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('answer_option_b')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('answer_option_c')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('answer_option_d')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->defaultItems(1)
                    ->createItemButtonLabel('Add Question')
                    ->collapsible()
                    ->cloneable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultGroup('lesson_id')->defaultSortOptionLabel('Lesson')
                ->groups([
                Group::make('lesson_id')
                    ->collapsible(),
                ])
            ->columns([
                Tables\Columns\TextColumn::make('lesson_id')
                    ->label('Lesson')
                    ->formatStateUsing(function ($record){
                        return Lesson::where("id", $record->lesson_id)->first()->title ?? "";
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('question'),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Total Qns')
                    ->formatStateUsing(function ($record){
                        return Quizz::where('lesson_id', $record->lesson_id)->count();
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\EditAction::make()
                    ->color('success')
                    ->successRedirectUrl('quizzs'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListQuizzs::route('/'),
            'create' => Pages\CreateQuizz::route('/create'),
            'edit' => Pages\EditQuizz::route('/{record}/edit'),
        ];
    }
}
