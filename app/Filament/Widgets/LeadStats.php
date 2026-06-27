<?php

namespace App\Filament\Widgets;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadStats extends StatsOverviewWidget
{
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        $user = auth()->user();

        $query = Lead::query();

        if (! $user->hasRole('Platform Admin')) {

            if ($user->hasRole('Agent')) {
                $query->where('assigned_to', $user->id);
            } else {
                $query->where('company_id', $user->company_id);
            }
        }

        return [
            Stat::make(
                'New',
                (clone $query)
                    ->where('status', LeadStatus::NEW)
                    ->count()
            ),

            Stat::make(
                'Contacted',
                (clone $query)
                    ->where('status', LeadStatus::CONTACTED)
                    ->count()
            ),

            Stat::make(
                'Qualified',
                (clone $query)
                    ->where('status', LeadStatus::QUALIFIED)
                    ->count()
            ),

            Stat::make(
                'Viewing',
                (clone $query)
                    ->where('status', LeadStatus::VIEWING)
                    ->count()
            ),

            Stat::make(
                'Negotiation',
                (clone $query)
                    ->where('status', LeadStatus::NEGOTIATION)
                    ->count()
            ),

            Stat::make(
                'Won',
                (clone $query)
                    ->where('status', LeadStatus::WON)
                    ->count()
            ),

            Stat::make(
                'Lost',
                (clone $query)
                    ->where('status', LeadStatus::LOST)
                    ->count()
            ),
        ];
    }
}
