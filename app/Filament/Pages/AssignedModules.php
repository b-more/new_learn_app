<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AssignedModules extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.assigned-modules';

    protected static ?int $navigationSort = 1;


    public function getSubheading(): string
    {
        return "Anti-Money Laundering | Transaction Monitoring | KYC Scanning [User Training]";
    }
}
