<?php

namespace App\Filament\Resources\Properties;

use App\Filament\Resources\Properties\Pages\CreateProperty;
use App\Filament\Resources\Properties\Pages\EditProperty;
use App\Filament\Resources\Properties\Pages\ListProperties;
use App\Filament\Resources\Properties\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\Properties\Schemas\PropertyForm;
use App\Filament\Resources\Properties\Tables\PropertiesTable;
use App\Models\Property;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;
    protected static ?int $navigationSort = 1;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|\UnitEnum|null $navigationGroup = 'CRM';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PropertyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PropertiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('Platform Admin')) {
            return parent::getEloquentQuery()
                ->with('coverImage');
        }

        return parent::getEloquentQuery()
            ->where(
                'company_id',
                auth()->user()->company_id
            )
            ->with('coverImage');
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole([
            'Platform Admin',
            'Owner',
            'Super Admin',
            'Manager',
            'Agent',
        ]);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasAnyRole([
            'Platform Admin',
            'Owner',
            'Super Admin',
            'Manager',
            'Agent',
        ]);
    }

    public static function canEdit($record): bool
    {
        $user = auth()->user();

        if (
            $user->hasRole('Platform Admin') ||
            $user->hasRole('Owner') ||
            $user->hasRole('Super Admin') ||
            $user->hasRole('Manager')
        ) {
            return true;
        }

        if ($user->hasRole('Agent')) {
            return $record->user_id === $user->id;
        }

        return false;
    }
    public static function canDelete($record): bool
    {
        $user = auth()->user();

        return $user->hasAnyRole([
            'Platform Admin',
            'Owner',
            'Super Admin',
        ]);
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'reference_number',
            'title',
        ];
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->reference_number . ' - ' . $record->title;
    }
}
