<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkReadBranchPermission;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkReadBranchPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "module" => "Permission",
            "activity" => "Viewed List Permission Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
