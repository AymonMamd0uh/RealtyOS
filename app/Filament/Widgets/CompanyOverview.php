<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompanyOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 0;
protected int|string|array $columnSpan = 'full';
    protected function getStats(): array
    {
        $user = auth()->user();

        $company = $user->company;

        $companyId = $company?->id;

        return [

            Stat::make(
                'Company',
                $company?->name ?? 'N/A'
            )
                ->description('Your Company')
                ->descriptionIcon('heroicon-o-building-office-2', IconPosition::Before)
                ->color('primary'),

            Stat::make(
                'Agents',
                User::where('company_id', $companyId)
                    ->role('Agent')
                    ->count()
            )
                ->description('Active Agents')
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->color('info'),

            Stat::make(
                'Properties',
                Property::where('company_id', $companyId)->count()
            )
                ->description('Listed Properties')
                ->descriptionIcon('heroicon-o-home', IconPosition::Before)
                ->color('warning'),

            Stat::make(
                'Leads',
                Lead::where('company_id', $companyId)->count()
            )
                ->description('Active Leads')
                ->descriptionIcon('heroicon-o-user-plus', IconPosition::Before)
                ->color('success'),

        ];
    }

    public static function canView(): bool
    {
        return auth()->check()
            && ! auth()->user()->hasRole('Platform Admin');
    }
}