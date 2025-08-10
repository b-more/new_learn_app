<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Branch;
use App\Models\ExamCategory;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserModuleProgress;
use App\Services\ActivityTrackingService;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportBulkAction as ActionsExportBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;

// NEW IMPORTS FOR DASHBOARD INTEGRATION
use Filament\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;

//Audit Trails
function checkCreateAuthTrailsPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadAuthTrailsPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateAuthTrailsPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteAuthTrailsPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Audit Trails')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

//Branch
function checkCreateBranchPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Branch')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Branch')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadBranchPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Branch')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Branch')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateBranchPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Branch')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Branch')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteBranchPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Branch')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Branch')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

//Module
function checkCreateModulePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Module')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Module')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadModulePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Module')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Module')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateModulePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Module')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Module')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteModulePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Module')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Module')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

//Lesson
function checkCreateLessonPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadLessonPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateLessonPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteLessonPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Lesson')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

//Quiz
function checkCreateQuizPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadQuizPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateQuizPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteQuizPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Quiz')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

//Permission
function checkCreateQuizScorePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Permission')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Permission')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadQuizScorePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateQuizScorePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteQuizScorePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'QuizScore')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

//Role
function checkCreateRolePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Role')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Role')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadRolePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Role')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Role')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateRolePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Role')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Role')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteRolePermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Role')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Role')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

//User
function checkCreateUserPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'User')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'User')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadUserPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'User')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'User')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdateUserPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'User')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'User')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeleteUserPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'User')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'User')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
    }
    return false;
}

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-m-user-circle';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 8;

    public static function getNavigationLabel(): string
    {
        return 'System Users';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return checkReadUserPermission();
    }

    // 1. ADD NAVIGATION BADGE - Shows total user count
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    // Optional: Badge color based on user count
    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::count();
        return match (true) {
            $count > 100 => 'success',
            $count > 50 => 'warning',
            default => 'primary'
        };
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->aside()
                    ->description("Fill in user details")
                    ->schema([
                        Forms\Components\TextInput::make("name")
                            ->prefix('Full Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make("email")
                                    ->prefix('Email')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('password')
                                    ->minLength(8)
                                    ->prefix('Password')
                                    ->password()
                                    ->maxLength(255)
                                    ->dehydrateStateUsing(static fn(null|string $state): null|string => filled($state) ? Hash::make($state) : null)
                                    ->required(static fn(Page $livewire): bool => $livewire instanceof Pages\CreateUser)
                                    ->dehydrated(static fn(null|string $state): bool => filled($state))
                                    ->label(static fn(Page $livewire):  string =>
                                    ($livewire instanceof EditUser) ? 'New Password' : 'password'
                                    ),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make("branch_id")
                                    ->label("Branch")
                                    ->options(Branch::all()->pluck('name','id')->toArray())
                                    ->required(),
                                Forms\Components\Select::make("role_id")
                                    ->label("User Role")
                                    ->options(Role::all()->pluck('name','id')->toArray())
                                    ->required()
                            ]),
                        Forms\Components\Select::make('modules')
                            ->relationship('modules', 'title')
                            ->label('Assign Modules')
                            ->preload()
                            ->multiple()
                            ->required()
                            // 2. ADD ACTIVITY TRACKING ON MODULE ASSIGNMENT
                            ->afterStateUpdated(function ($state, $record) {
                                if ($record && $state) {
                                    static::trackModuleAssignment($record, $state);
                                }
                            })
                    ])
            ]);
    }

    // NEW: Define the infolist for viewing user details
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('User Information')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Full Name')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight('bold'),
                        TextEntry::make('email')
                            ->label('Email Address')
                            ->copyable()
                            ->icon('heroicon-o-envelope'),
                        TextEntry::make('role.name')
                            ->label('Role')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('branch.name')
                            ->label('Branch')
                            ->badge()
                            ->color('success'),
                    ])
                    ->columns(2),

                Section::make('Module Assignment & Progress')
                    ->schema([
                        TextEntry::make('modules.title')
                            ->label('Assigned Modules')
                            ->badge()
                            ->color('primary')
                            ->separator(','),
                        TextEntry::make('overall_progress')
                            ->label('Overall Progress')
                            ->getStateUsing(function ($record) {
                                $totalModules = $record->modules()->count();
                                if ($totalModules == 0) return '0% (No modules assigned)';

                                $completedModules = UserModuleProgress::where('user_id', $record->id)
                                    ->where('status', 'completed')
                                    ->count();

                                $percentage = round(($completedModules / $totalModules) * 100, 1);
                                return $percentage . '% (' . $completedModules . '/' . $totalModules . ' modules completed)';
                            })
                            ->badge()
                            ->color(fn (string $state): string => match (true) {
                                str_contains($state, '100%') => 'success',
                                (float) str_replace('%', '', explode(' ', $state)[0]) >= 70 => 'warning',
                                (float) str_replace('%', '', explode(' ', $state)[0]) > 0 => 'info',
                                default => 'gray',
                            }),
                    ])
                    ->columns(1),

                Section::make('Performance & Activity')
                    ->schema([
                        TextEntry::make('quiz_stats')
                            ->label('Quiz Statistics')
                            ->getStateUsing(function ($record) {
                                $totalSessions = \App\Models\AttemptAnswer::where('user_id', $record->id)
                                    ->whereNotNull('session_id')
                                    ->where('session_status', 'completed')
                                    ->distinct('session_id')
                                    ->count();
                                $totalAttempts = \App\Models\AttemptAnswer::where('user_id', $record->id)->count();

                                return "{$totalSessions} sessions • {$totalAttempts} total attempts";
                            })
                            ->icon('heroicon-o-chart-bar'),
                        TextEntry::make('last_activity')
                            ->label('Last Activity')
                            ->getStateUsing(function ($record) {
                                $lastActivity = \App\Models\AuditTrail::where('user_id', $record->id)
                                    ->orderBy('activity_timestamp', 'desc')
                                    ->first();

                                return $lastActivity ? $lastActivity->activity_timestamp->diffForHumans() : 'No activity recorded';
                            })
                            ->badge()
                            ->color(function ($record) {
                                $lastActivity = \App\Models\AuditTrail::where('user_id', $record->id)
                                    ->orderBy('activity_timestamp', 'desc')
                                    ->first();

                                if (!$lastActivity) return 'gray';

                                $daysSince = $lastActivity->activity_timestamp->diffInDays(now());
                                return match (true) {
                                    $daysSince <= 1 => 'success',
                                    $daysSince <= 7 => 'warning',
                                    default => 'danger'
                                };
                            })
                            ->icon('heroicon-o-clock'),
                        TextEntry::make('created_at')
                            ->label('Member Since')
                            ->dateTime('M j, Y')
                            ->icon('heroicon-o-user-plus'),
                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('M j, Y g:i A')
                            ->icon('heroicon-o-pencil-square'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Full Name(s)')
                    ->searchable()
                    ->sortable()
                    ->description(function ($record){
                        return $record->email ?? "";
                    }),

                // 3. ADD PROGRESS COLUMN - Shows overall module completion
                Tables\Columns\TextColumn::make('overall_progress')
                    ->label('Progress')
                    ->getStateUsing(function ($record) {
                        $totalModules = $record->modules()->count();
                        if ($totalModules == 0) return '0%';

                        $completedModules = UserModuleProgress::where('user_id', $record->id)
                            ->where('status', 'completed')
                            ->count();

                        $percentage = round(($completedModules / $totalModules) * 100, 1);
                        return $percentage . '%';
                    })
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        str_contains($state, '100%') => 'success',
                        (float) str_replace('%', '', $state) >= 70 => 'warning',
                        (float) str_replace('%', '', $state) > 0 => 'info',
                        default => 'gray',
                    })
                    ->sortable()
                    ->tooltip(function ($record) {
                        $progress = UserModuleProgress::where('user_id', $record->id)->with('module')->get();
                        if ($progress->isEmpty()) return 'No progress data';

                        $details = $progress->map(function ($p) {
                            return ($p->module->title ?? 'Unknown Module') . ': ' . number_format($p->overall_progress ?? 0, 1) . '%';
                        })->join("\n");
                        return $details;
                    }),

                Tables\Columns\TextColumn::make('user_id')
                    ->label('Created/Updated By')
                    ->formatStateUsing(function ($state){
                        return User::where("id", $state)->first()->name ?? "";
                    })
                    ->description(function ($record){
                        return User::where('id',$record->updated_by)->first()->name ?? "";
                    }),

                Tables\Columns\TextColumn::make('role_id')
                    ->formatStateUsing(function ($record){
                        return Role::where('id', $record->role_id)->first()->name ?? "";
                    })
                    ->label('Role'),

                Tables\Columns\TextColumn::make('modules.title')
                    ->label('Assigned Modules')
                    ->badge()
                    ->searchable()
                    ->wrap()
                    ->tooltip(function ($record) {
                        $moduleCount = $record->modules()->count();
                        return "Total: {$moduleCount} modules assigned";
                    }),

                // ADD ACTIVITY STATUS COLUMN
                Tables\Columns\TextColumn::make('last_activity')
                    ->label('Last Activity')
                    ->getStateUsing(function ($record) {
                        $lastActivity = \App\Models\AuditTrail::where('user_id', $record->id)
                            ->orderBy('activity_timestamp', 'desc')
                            ->first();

                        return $lastActivity ? $lastActivity->activity_timestamp->diffForHumans() : 'No activity';
                    })
                    ->badge()
                    ->color(function ($record) {
                        $lastActivity = \App\Models\AuditTrail::where('user_id', $record->id)
                            ->orderBy('activity_timestamp', 'desc')
                            ->first();

                        if (!$lastActivity) return 'gray';

                        $daysSince = $lastActivity->activity_timestamp->diffInDays(now());
                        return match (true) {
                            $daysSince <= 1 => 'success',  // Active today/yesterday
                            $daysSince <= 7 => 'warning',  // Active this week
                            default => 'danger'            // Inactive
                        };
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('branch_id')
                    ->formatStateUsing(function ($record){
                        return Branch::where('id', $record->branch_id)->first()->name ?? "";
                    })
                    ->label('Branch Name'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created/Updated At')
                    ->dateTime()
                    ->description(function ($record){
                        return $record->updated_at;
                    })
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('modules')
                    ->relationship('modules', 'title')
                    ->multiple()
                    ->preload(),
                SelectFilter::make('role_id')
                    ->multiple()
                    ->label('Role')
                    ->options(Role::all()->pluck('name','id')->toArray()),
                SelectFilter::make('branch_id')
                    ->multiple()
                    ->label('Branch')
                    ->options(Branch::all()->pluck('name','id')->toArray()),

                // ADD PROGRESS FILTER
                SelectFilter::make('progress_status')
                    ->label('Progress Status')
                    ->options([
                        'completed' => 'Completed (100%)',
                        'in_progress' => 'In Progress (1-99%)',
                        'not_started' => 'Not Started (0%)',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['value'], function ($query, $status) {
                            return match($status) {
                                'completed' => $query->whereHas('moduleProgress', fn($q) =>
                                    $q->where('status', 'completed')),
                                'in_progress' => $query->whereHas('moduleProgress', fn($q) =>
                                    $q->where('status', 'in_progress')),
                                'not_started' => $query->whereDoesntHave('moduleProgress')
                                    ->orWhereHas('moduleProgress', fn($q) =>
                                        $q->where('overall_progress', 0)),
                                default => $query
                            };
                        });
                    }),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                // NEW: View action
                Tables\Actions\ViewAction::make()
                    ->color('info'),

                // Existing edit action
                Tables\Actions\EditAction::make(),

                // NEW: Performance Dashboard Action
                Tables\Actions\Action::make('viewDashboard')
                    ->label('Performance Dashboard')
                    ->icon('heroicon-o-chart-bar')
                    ->color('success')
                    ->url(fn ($record): string => route('admin.user-dashboard', ['userId' => $record->id]))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->modules()->count() > 0)
                    ->tooltip('View comprehensive performance analytics'),

                // NEW: Download PDF Action
                Tables\Actions\Action::make('downloadPDF')
                    ->label('Download Report')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('warning')
                    ->url(fn ($record): string => route('admin.user-dashboard.pdf', ['userId' => $record->id]))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->modules()->count() > 0)
                    ->tooltip('Download performance report as PDF'),

                // Existing progress view action (keep if you want it)
                Tables\Actions\Action::make('viewProgress')
                    ->label('Module Progress')
                    ->icon('heroicon-o-academic-cap')
                    ->color('info')
                    ->url(fn ($record): string => '/admin/users/' . $record->id)
                    ->visible(fn ($record) => $record->modules()->count() > 0)
                    ->tooltip('View detailed module progress'),
            ])
            ->bulkActions([
    Tables\Actions\BulkActionGroup::make([
        // FIXED: Custom CSV Export (replaces the problematic ActionsExportBulkAction)
        Tables\Actions\BulkAction::make('export')
            ->label('Download Users Report')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('success')
            ->action(function (Collection $records) {
                $filename = 'users_report_' . now()->format('Y_m_d_H_i_s') . '.csv';

                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                ];

                $callback = function() use ($records) {
                    $file = fopen('php://output', 'w');

                    // CSV Headers
                    fputcsv($file, [
                        'ID',
                        'Name',
                        'Email',
                        'Role',
                        'Branch',
                        'Assigned Modules',
                        'Overall Progress (%)',
                        'Last Activity',
                        'Total Quiz Attempts',
                        'Average Quiz Score (%)',
                        'Created At',
                        'Updated At'
                    ]);

                    // CSV Data
                    foreach ($records as $user) {
                        // Get assigned modules
                        $assignedModules = $user->modules()->pluck('title')->join(', ');

                        // Calculate overall progress
                        $totalModules = $user->modules()->count();
                        $completedModules = 0;
                        if ($totalModules > 0) {
                            $completedModules = \App\Models\UserModuleProgress::where('user_id', $user->id)
                                ->where('status', 'completed')
                                ->count();
                        }
                        $overallProgress = $totalModules > 0 ? round(($completedModules / $totalModules) * 100, 1) : 0;

                        // Get last activity
                        $lastActivity = \App\Models\AuditTrail::where('user_id', $user->id)
                            ->orderBy('activity_timestamp', 'desc')
                            ->first();
                        $lastActivityFormatted = $lastActivity ? $lastActivity->activity_timestamp->format('Y-m-d H:i:s') : 'No activity';

                        // Get quiz stats
                        $totalQuizAttempts = \App\Models\AttemptAnswer::where('user_id', $user->id)
                            ->where('attempt_status', 'completed')
                            ->count();

                        $averageQuizScore = \App\Models\AttemptAnswer::where('user_id', $user->id)
                            ->where('attempt_status', 'completed')
                            ->avg('score_percentage');
                        $averageQuizScore = $averageQuizScore ? round($averageQuizScore, 2) : 0;

                        fputcsv($file, [
                            $user->id,
                            $user->name,
                            $user->email,
                            $user->role->name ?? 'N/A',
                            $user->branch->name ?? 'N/A',
                            $assignedModules ?: 'No modules assigned',
                            $overallProgress,
                            $lastActivityFormatted,
                            $totalQuizAttempts,
                            $averageQuizScore,
                            $user->created_at->format('Y-m-d H:i:s'),
                            $user->updated_at->format('Y-m-d H:i:s')
                        ]);
                    }

                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }),

        Tables\Actions\BulkAction::make('assignModules')
            ->label('Mass Assign Modules')
            ->icon('heroicon-o-book-open')
            ->action(function (Collection $records, array $data): void {
                try {
                    foreach ($records as $record) {
                        // Simple assignment without activity tracking
                        $record->modules()->syncWithoutDetaching($data['modules']);

                        // Create/update UserModuleProgress records
                        foreach ($data['modules'] as $moduleId) {
                            $module = \App\Models\Module::find($moduleId);
                            if ($module) {
                                $totalLessons = $module->lessons()->count();
                                $totalQuizzes = \DB::table('quizzs')
                                    ->whereIn('lesson_id', $module->lessons()->pluck('id'))
                                    ->count();

                                \App\Models\UserModuleProgress::updateOrCreate(
                                    ['user_id' => $record->id, 'module_id' => $moduleId],
                                    [
                                        'assigned_at' => now(),
                                        'total_lessons' => $totalLessons,
                                        'total_quizzes' => $totalQuizzes,
                                        'overall_progress' => 0,
                                        'status' => 'assigned'
                                    ]
                                );
                            }
                        }

                        // Simple audit log without ActivityTrackingService
                        foreach ($data['modules'] as $moduleId) {
                            \App\Models\AuditTrail::create([
                                'user_id' => auth()->id(),
                                'action_type' => 'module_assigned',
                                'module' => 'Module Assignment',
                                'activity_description' => "Assigned module to user: {$record->name}",
                                'activity_timestamp' => now(),
                                'additional_data' => json_encode([
                                    'resource_id' => $moduleId,
                                    'resource_type' => 'module',
                                    'target_user_id' => $record->id
                                ])
                            ]);
                        }
                    }

                    Notification::make()
                        ->title('Modules Assigned Successfully')
                        ->body(count($records) . ' users have been assigned ' . count($data['modules']) . ' modules')
                        ->success()
                        ->send();

                } catch (\Exception $e) {
                    \Log::error('Module assignment failed: ' . $e->getMessage(), [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);

                    Notification::make()
                        ->title('Assignment Failed')
                        ->body('Error: ' . $e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->deselectRecordsAfterCompletion()
            ->form([
                Forms\Components\Select::make('modules')
                    ->multiple()
                    ->preload()
                    ->label('Select Modules')
                    ->options(function () {
                        return \App\Models\Module::pluck('title', 'id');
                    })
                    ->required(),
            ]),

        Tables\Actions\BulkAction::make('unassignModules')
            ->label('Unassign Modules')
            ->icon('heroicon-o-book-open')
            ->color('danger')
            ->action(function (Collection $records, array $data): void {
                try {
                    foreach ($records as $record) {
                        $record->modules()->detach($data['modules']);

                        // Remove UserModuleProgress records for unassigned modules
                        \App\Models\UserModuleProgress::where('user_id', $record->id)
                            ->whereIn('module_id', $data['modules'])
                            ->delete();

                        // Log unassignment activity
                        foreach ($data['modules'] as $moduleId) {
                            \App\Models\AuditTrail::create([
                                'user_id' => auth()->id(),
                                'action_type' => 'module_unassigned',
                                'module' => 'Module Assignment',
                                'activity_description' => "Unassigned module from user: {$record->name}",
                                'activity_timestamp' => now(),
                                'additional_data' => json_encode([
                                    'resource_id' => $moduleId,
                                    'resource_type' => 'module',
                                    'target_user_id' => $record->id
                                ])
                            ]);
                        }
                    }

                    Notification::make()
                        ->title('Modules Unassigned Successfully')
                        ->body(count($records) . ' users have been unassigned from ' . count($data['modules']) . ' modules')
                        ->warning()
                        ->send();
                } catch (\Exception $e) {
                    \Log::error('Module unassignment failed: ' . $e->getMessage());

                    Notification::make()
                        ->title('Unassignment Failed')
                        ->body('Error occurred while unassigning modules')
                        ->danger()
                        ->send();
                }
            })
            ->deselectRecordsAfterCompletion()
            ->form([
                Forms\Components\Select::make('modules')
                    ->multiple()
                    ->preload()
                    ->label('Select Modules to Unassign')
                    ->options(function () {
                        return \App\Models\Module::pluck('title', 'id');
                    })
                    ->required(),
            ])
            ->requiresConfirmation(),
    ])
            ]);
    }

    // 2. ACTIVITY TRACKING METHODS
    protected static function trackModuleAssignment($user, $moduleIds)
    {
        try {
            $activityService = app(ActivityTrackingService::class);

            if (is_array($moduleIds)) {
                foreach ($moduleIds as $moduleId) {
                    $activityService->trackModuleAssignment($user->id, $moduleId, auth()->id());
                }
            }
        } catch (\Exception $e) {
            // Log error but don't break the flow
            \Log::error('Failed to track module assignment: ' . $e->getMessage());
        }
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // UPDATED: Add view page to the pages array
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),  // NEW: Added view page
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
