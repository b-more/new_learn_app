<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Modules extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.modules';

    protected static ?int $navigationSort = 2;


    public function getSubheading(): string
    {
        return "Anti-Money Laundering | Transaction Monitoring | KYC Scanning [User Training]";
    }
}
