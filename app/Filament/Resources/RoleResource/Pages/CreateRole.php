<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\AuditTrail;
use App\Models\Permission;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use function App\Filament\Resources\checkCreateRolePermission;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkCreateRolePermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "module" => "Role",
            "activity" => "Viewed Create Role Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate()
    {
        $record = $this->record;
        Log::info("created record", ["record" => $record]);

        $modules = [
            [
                "name" => "Audit Trails",
            ],
            [
                "name" => "Branch",
            ],
            [
                "name" => "Country",
            ],
            [
                "name" => "Nationality",
            ],
            [
                "name" => "Permission",
            ],
            [
                "name" => "Role",
            ],
            [
                "name" => "Screening Dataset",
            ],
            [
                "name" => "Search Category",
            ],
            [
                "name" => "Suspicious Case",
            ],
            [
                "name" => "Transaction",
            ],
            [
                "name" => "Transaction Type",
            ],
            [
                "name" => "User",
            ],
            [
                "name" => "Watchlist",
            ]
        ];

        foreach ($modules as $module)
        {
            $new_permission = Permission::create([
                "role_id" => $record->id,
                "module" => $module["name"],
                "create" => 0,
                "read" => 0,
                "update" => 0,
                "delete" => 0
            ]);

            $new_permission->save();
        }

        $user = Auth::user();
        $record = $this->record;

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "module" => "Roles",
            "activity" => "Saved record => ".$record,
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
