<?php

namespace App\Filament\Resources\BranchResource\Pages;

use App\Filament\Resources\BranchResource;
use App\Models\AuditTrail;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use function App\Filament\Resources\checkCreateBranchPermission;

class CreateBranch extends CreateRecord
{
    protected static string $resource = BranchResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        $user = Auth::user();
        abort_unless(checkCreateBranchPermission(),403);

        $activity = AuditTrail::create([
            "user_id" => $user->id,
            "module" => "Branch",
            "activity" => "Viewed Create Branch Page",
            "ip_address" => request()->ip()
        ]);

        $activity->save();
    }
}
