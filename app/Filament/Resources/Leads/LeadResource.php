<?php

namespace App\Filament\Resources\Leads;

use App\Filament\Resources\Leads\Pages\CreateLead;
use App\Filament\Resources\Leads\Pages\EditLead;
use App\Filament\Resources\Leads\Pages\ListLeads;
use App\Filament\Resources\Leads\Schemas\LeadForm;
use App\Filament\Resources\Leads\Tables\LeadsTable;
use App\Models\Lead;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Leads\RelationManagers\ActivitiesRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|\UnitEnum|null $navigationGroup = 'CRM';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return LeadForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeadsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeads::route('/'),
            'create' => CreateLead::route('/create'),
            'edit' => EditLead::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user->hasRole('Platform Admin')) {
            return parent::getEloquentQuery();
        }

        if ($user->hasRole('Agent')) {
            return parent::getEloquentQuery()
                ->where('assigned_to', $user->id);
        }

        return parent::getEloquentQuery()
            ->where('company_id', $user->company_id);
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
            return $record->assigned_to === $user->id;
        }

        return false;
    }
    public static function getGloballySearchableAttributes(): array
    {
        return [
            'name',
            'phone',
            'email',
        ];
    }

    public static function getGlobalSearchResultTitle($record): string
    {
        return $record->name . ' - ' . $record->phone;
    }
}
