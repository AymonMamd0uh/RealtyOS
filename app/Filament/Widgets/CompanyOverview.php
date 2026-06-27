<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompanyOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $user = auth()->user();

        $companyId = $user->company_id;

        return [

            Stat::make(
                'Company',
                $user->company?->name ?? 'N/A'
            )
                ->description('Current Company'),

            Stat::make(
                'Properties',
                Property::where('company_id', $companyId)->count()
            ),

            Stat::make(
                'Leads',
                Lead::where('company_id', $companyId)->count()
            ),

            Stat::make(
                'Agents',
                User::where('company_id', $companyId)
                    ->role('Agent')
                    ->count()
            ),
        ];
    }

    public static function canView(): bool
    {
        return ! auth()->user()->hasRole('Platform Admin');
    }
}