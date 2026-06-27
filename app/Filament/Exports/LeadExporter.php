<?php

namespace App\Filament\Exports;

use App\Models\Lead;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class LeadExporter extends Exporter
{
    protected static ?string $model = Lead::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),
            ExportColumn::make('phone'),
            ExportColumn::make('assignedTo.name')
                ->label('Agent'),
            ExportColumn::make('property.title')
                ->label('Property'),
            ExportColumn::make('status')
                ->formatStateUsing(fn($state) => $state?->value ?? ''),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your lead export has completed and '
            . Number::format($export->successful_rows)
            . ' rows exported.';

        return $body;
    }
}
