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

                Forms\Components\TextInput::make('video_length'),

                Forms\Components\FileUpload::make('video_thumbnail')
                    ->label('Lesson Thumbnail/Poster')
                    ->directory('thumbnail')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp', 'image/bmp']) // Accept only images
                    ->required()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '5:4'
                    ])

                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('video_url')
                        ->label('video')
                        ->directory('lessons')
                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mpeg', 'video/quicktime'])  // Allowable formats
                    ->maxSize(51200) // 50MB maximum size
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '5:4'
                        ])
                        ->columnSpanFull(),
                // Add FileUpload for documents
                Forms\Components\FileUpload::make('documents')
                    ->label('Lesson Documents')
                    ->directory('lessons/documents')
                    ->multiple() // Allow multiple uploads
                    ->columnSpanFull(),

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
                // Display documents as download links
                Tables\Columns\TextColumn::make('documents')
                    ->label('Documents')
                    ->formatStateUsing(function ($record) {
                        if ($record->documents) {
                            return collect($record->documents)->map(function ($document) {
                                return "<a href='" . asset('storage/' . $document) . "' download>" . basename($document) . "</a>";
                            })->implode(', ');
                        }
                        return 'No Documents';
                    })
                    ->html(),

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
                Tables\Actions\EditAction::make()
                    ->successRedirectUrl('lessons'),
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
