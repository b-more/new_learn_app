<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizScoreResource\Pages;
use App\Filament\Resources\QuizScoreResource\RelationManagers;
use App\Models\AttemptAnswer;
use App\Models\QuizScore;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizScoreResource extends Resource
{
    protected static ?string $model = AttemptAnswer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Progress Report';

    public static $title = "Progress Report";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')->label('User'),
                Tables\Columns\ViewColumn::make('total')->label('AssignedQuiz')->view('tables.columns.total-assigned-quiz'),
                Tables\Columns\ViewColumn::make('attempts')->label('Attempts')->view('tables.columns.attempts'),
                Tables\Columns\ViewColumn::make('passes')->view('tables.columns.passes'),
                Tables\Columns\ViewColumn::make('fails')->view('tables.columns.fails'),
                Tables\Columns\TextColumn::make('updated_at')->label('Attempted On')
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('details'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListQuizScores::route('/'),
            //'create' => Pages\CreateQuizScore::route('/create'),
            'edit' => Pages\EditQuizScore::route('/{record}/edit'),
        ];
    }
}
