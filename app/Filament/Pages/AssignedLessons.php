<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AssignedLessons extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.assigned-lessons';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
