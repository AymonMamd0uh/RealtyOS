<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AgentPerformance;
use App\Filament\Widgets\ConversionRate;
use App\Filament\Widgets\LeadStats;
use App\Filament\Widgets\LeadsChart;
use Filament\Pages\Page;

class Reports extends Page
{
    protected static ?string $navigationLabel = 'Reports';

    protected static string|\UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.reports';

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->hasAnyRole([
            'Platform Admin',
            'Owner',
            'Super Admin',
            'Manager',
        ]);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ConversionRate::class,
            LeadStats::class,
            LeadsChart::class,
            AgentPerformance::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }
}
