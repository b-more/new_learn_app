<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-home';

    protected static ?string $title = 'Dashboard';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.dashboard';

    public function getSubheading(): string
    {
        return "Anti-Money Laundering | Transaction Monitoring | KYC Scanning [User Training]";
    }
}
