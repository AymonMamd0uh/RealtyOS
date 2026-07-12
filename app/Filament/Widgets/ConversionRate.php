<?php

namespace App\Filament\Widgets;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConversionRate extends StatsOverviewWidget
{
    protected static ?int $sort = 6;
protected int|string|array $columnSpan = 'full';
    protected function getStats(): array
    {
        $user = auth()->user();

        $query = Lead::query();

        if ($user->hasRole('Agent')) {
            $query->where('assigned_to', $user->id);
        } elseif (! $user->hasRole('Platform Admin')) {
            $query->where('company_id', $user->company_id);
        }

        $totalLeads = (clone $query)->count();

        $wonLeads = (clone $query)
            ->where('status', LeadStatus::WON)
            ->count();

        $lostLeads = (clone $query)
            ->where('status', LeadStatus::LOST)
            ->count();

        $conversionRate = $totalLeads > 0
            ? round(($wonLeads / $totalLeads) * 100, 1)
            : 0;

        return [

            Stat::make('Conversion Rate', "{$conversionRate}%")
                ->description('Won leads out of total leads')
                ->descriptionIcon('heroicon-o-chart-bar-square', IconPosition::Before)
                ->color(
                    match (true) {
                        $conversionRate >= 70 => 'success',
                        $conversionRate >= 40 => 'warning',
                        default => 'danger',
                    }
                ),

            Stat::make('Won Leads', $wonLeads)
                ->description('Successfully closed')
                ->descriptionIcon('heroicon-o-trophy', IconPosition::Before)
                ->color('success'),

            Stat::make('Lost Leads', $lostLeads)
                ->description('Closed without success')
                ->descriptionIcon('heroicon-o-x-circle', IconPosition::Before)
                ->color('danger'),

        ];
    }

    public static function canView(): bool
    {
        return auth()->check();
    }
}