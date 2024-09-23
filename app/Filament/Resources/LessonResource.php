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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('module_id')
                    ->options(Module::all()->pluck('title', 'id')->toArray())
                    ->required()
                    ->label('Module Name'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Lesson Title'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('Lesson Description')
                    ->columnSpanFull(),

                // FileUpload for Video File
                Forms\Components\FileUpload::make('video_url')
                    ->label('Upload Video')
                    ->directory('lessons')  // Upload to public/lessons directory
                    ->disk('public')
                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mpeg', 'video/quicktime'])  // Allowable formats
                    ->maxSize(51200) // 50MB maximum size
                    ->required(),

                Forms\Components\TextInput::make('video_length')
                    ->postfix('mins')
                    ->placeholder('05:24')
                    ->required()
                    ->label('Video Length'),

                // FileUpload for Thumbnail
                Forms\Components\FileUpload::make('video_thumbnail')
                    ->label('Upload Thumbnail')
                    ->directory('thumbnails')  // Upload to public/thumbnails directory
                    ->disk('public')
                    ->image()
                    ->maxSize(1024) // 1MB maximum size
                    ->required(),
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
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Lesson Title'),

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
                    ->disk('public')  // Specify the disk where the file is stored
                    ->visible(fn($record) => $record->video_thumbnail ?? ""),  // Ensure it's only displayed if a thumbnail exists

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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
