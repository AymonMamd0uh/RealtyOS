<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConversionRate extends StatsOverviewWidget
{
   protected static ?int $sort = 5;

    protected function getStats(): array
    {
        $user = auth()->user();

        $query = Lead::query();

        if (! $user->hasRole('Platform Admin')) {
            $query->where('company_id', $user->company_id);
        }

        if ($user->hasRole('Agent')) {
            $query->where('assigned_to', $user->id);
        }

        $totalLeads = (clone $query)->count();

        $wonLeads = (clone $query)
            ->where('status', 'won')
            ->count();

        $lostLeads = (clone $query)
            ->where('status', 'lost')
            ->count();

        $conversionRate = $totalLeads > 0
            ? round(($wonLeads / $totalLeads) * 100, 2)
            : 0;

        return [

            Stat::make(
                'Conversion Rate',
                $conversionRate . '%'
            )
                ->description('Won Leads / Total Leads'),

            Stat::make(
                'Won Leads',
                $wonLeads
            ),

            Stat::make(
                'Lost Leads',
                $lostLeads
            ),
        ];
    }
}