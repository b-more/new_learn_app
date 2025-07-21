<?php

// app/Filament/Resources/UserProgressResource/Pages/ListUserProgress.php

namespace App\Filament\Resources\UserProgressResource\Pages;

use App\Filament\Resources\UserProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUserProgress extends ListRecords
{
    protected static string $resource = UserProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('sync_progress')
                ->label('Sync All Progress')
                ->icon('heroicon-o-arrow-path')
                ->action(function () {
                    // Sync all user progress
                    $this->notify('success', 'Progress sync initiated');
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Progress')
                ->badge($this->getModel()::count()),

            'in_progress' => Tab::make('In Progress')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'in_progress'))
                ->badge($this->getModel()::where('status', 'in_progress')->count()),

            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'completed'))
                ->badge($this->getModel()::where('status', 'completed')->count()),

            'assigned' => Tab::make('Assigned')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'assigned'))
                ->badge($this->getModel()::where('status', 'assigned')->count()),
        ];
    }
}
