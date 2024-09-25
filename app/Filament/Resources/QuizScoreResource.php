<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizScoreResource\Pages;
use App\Filament\Resources\QuizScoreResource\RelationManagers;
use App\Models\AttemptAnswer;
use App\Models\QuizScore;
use App\Models\User;
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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        return $query->select('id', 'user_id','updated_at')
            ->groupBy('user_id')
            ->orderBy('updated_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('')
                    ->content(function ($record){
                        $name = User::where('id', $record->user_id)->first()->name ?? "";
                        return view('user_attempt', compact('name'));
                    })
                    ->columnSpanFull(),
                Forms\Components\Placeholder::make('')
                    ->content(function ($record){
                        $quizzes = AttemptAnswer::where('user_id', $record->user_id)->get();
                        return view('quizz_details', compact('quizzes'));
                    })
                ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')->label('User')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function($record){
                        return User::where('id',$record->user_id)->first()->name ?? "";
                    }),
                Tables\Columns\ViewColumn::make('total')->label('AssignedQuiz')->view('tables.columns.total-assigned-quiz'),
                Tables\Columns\ViewColumn::make('attempts')->label('Attempts')->view('tables.columns.attempts'),
                Tables\Columns\ViewColumn::make('passes')->view('tables.columns.passes'),
                Tables\Columns\ViewColumn::make('fails')->view('tables.columns.fails'),
                Tables\Columns\TextColumn::make('updated_at')->label('Attempted On')
                    ->sortable()
                    ->searchable()
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
