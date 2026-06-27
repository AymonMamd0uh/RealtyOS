<?php

namespace App\Filament\Resources\Stages;

use App\Filament\Resources\Stages\Pages\CreateStage;
use App\Filament\Resources\Stages\Pages\EditStage;
use App\Filament\Resources\Stages\Pages\ListStages;
use App\Filament\Resources\Stages\Schemas\StageForm;
use App\Filament\Resources\Stages\Tables\StagesTable;
use App\Models\Stage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StageResource extends Resource
{
    protected static ?string $model = Stage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|\UnitEnum|null $navigationGroup = 'Locations';
    protected static ?string $navigationLabel = 'Stages';

    protected static ?int $navigationSort = 14;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return StageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StagesTable::configure($table);
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
            'index' => ListStages::route('/'),
            'create' => CreateStage::route('/create'),
            'edit' => EditStage::route('/{record}/edit'),
        ];
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
        return auth()->user()->hasRole('Platform Admin');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasRole('Platform Admin');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->hasRole('Platform Admin');
    }
}
