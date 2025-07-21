<?php

namespace App\Filament\Resources\UserProgressResource\Pages;

use App\Filament\Resources\UserProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserProgress extends CreateRecord
{
    protected static string $resource = UserProgressResource::class;
}

// app/Filament/Resources/UserProgressResource/Pages/ViewUserProgress.php

namespace App\Filament\Resources\UserProgressResource\Pages;

use App\Filament\Resources\UserProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUserProgress extends ViewRecord
{
    protected static string $resource = UserProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
