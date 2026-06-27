<?php

namespace App\Filament\Exports;

use App\Models\Property;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class PropertyExporter extends Exporter
{
    protected static ?string $model = Property::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('reference_number'),
            ExportColumn::make('title'),
            ExportColumn::make('price'),

            ExportColumn::make('user.name')
                ->label('Agent'),

            ExportColumn::make('city.name')
                ->label('City'),

            ExportColumn::make('area.name')
                ->label('Area'),

            ExportColumn::make('compound.name')
                ->label('Compound'),

            ExportColumn::make('property_type')
                ->formatStateUsing(fn($state) => $state?->value ?? ''),
            ExportColumn::make('listing_type')
                ->formatStateUsing(fn($state) => $state?->value ?? ''),

            ExportColumn::make('status')
                ->formatStateUsing(fn($state) => $state?->value ?? ''),
        ];
    }
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your property export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
