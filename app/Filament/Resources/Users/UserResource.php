<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?int $navigationSort = 22;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|\UnitEnum|null $navigationGroup = 'System';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('Platform Admin')) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()
            ->where(
                'company_id',
                auth()->user()->company_id
            );
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole([
            'Platform Admin',
            'Owner',
            'Super Admin',
            'Manager',
        ]);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole([
            'Platform Admin',
            'Owner',
            'Super Admin',
        ]);
    }

    public static function canEdit($record): bool
    {
        $user = auth()->user();

        if ($user->hasRole('Platform Admin')) {
            return true;
        }

        if (! $user->hasAnyRole(['Owner', 'Super Admin'])) {
            return false;
        }

        return $record->company_id === $user->company_id;
    }

    public static function canDelete($record): bool
    {
        if ($record->id === auth()->id()) {
            return false;
        }
        if (auth()->user()->hasRole('Platform Admin')) {
            return true;
        }

        return $record->company_id === auth()->user()->company_id
            && auth()->user()->hasAnyRole([
                'Owner',
                'Super Admin',
            ]);
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'email',
            'phone',
        ];
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->name;
    }
}
