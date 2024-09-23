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



//Permission
function checkCreatePermissionPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Permission')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Permission')->where('role_id', $user->role_id)->first()->create == 1 ?? false;
    }
    return false;
}

function checkReadPermissionPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Permission')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Permission')->where('role_id', $user->role_id)->first()->read == 1 ?? false;
    }
    return false;
}

function checkUpdatePermissionPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Permission')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Permission')->where('role_id', $user->role_id)->first()->update == 1 ?? false;
    }
    return false;
}

function checkDeletePermissionPermission(): bool
{
    $user = Auth::user();
    if(Permission::where('module', 'Permission')->where('role_id', $user->role_id)->count() > 0){
        return Permission::where('module', 'Permission')->where('role_id', $user->role_id)->first()->delete == 1 ?? false;
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
                            ])

                    ])
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
                SelectFilter::make('role_id')
                ->multiple()
                ->label('Role')
                ->options(Role::all()->pluck('name','id')->toArray()),
            SelectFilter::make('branch_id')
                ->multiple()
                ->label('Branch')
                ->options(Branch::all()->pluck('name','id')->toArray()),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ActionsExportBulkAction::make()
                    ->label('Download Users Report'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
