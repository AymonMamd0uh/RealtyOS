<?php

namespace App\Filament\Widgets;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadStats extends StatsOverviewWidget
{
    protected static ?int $sort = 3;
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

        return [

            Stat::make(
                'New',
                (clone $query)
                    ->where('status', LeadStatus::NEW)
                    ->count()
            )
                ->description('Newly received leads')
                ->descriptionIcon('heroicon-o-sparkles', IconPosition::Before)
                ->color('gray'),

            Stat::make(
                'Contacted',
                (clone $query)
                    ->where('status', LeadStatus::CONTACTED)
                    ->count()
            )
                ->description('Initial contact completed')
                ->descriptionIcon('heroicon-o-phone', IconPosition::Before)
                ->color('info'),

            Stat::make(
                'Qualified',
                (clone $query)
                    ->where('status', LeadStatus::QUALIFIED)
                    ->count()
            )
                ->description('Qualified opportunities')
                ->descriptionIcon('heroicon-o-check-badge', IconPosition::Before)
                ->color('success'),

            Stat::make(
                'Viewing',
                (clone $query)
                    ->where('status', LeadStatus::VIEWING)
                    ->count()
            )
                ->description('Property viewings')
                ->descriptionIcon('heroicon-o-home', IconPosition::Before)
                ->color('warning'),

            Stat::make(
                'Negotiation',
                (clone $query)
                    ->where('status', LeadStatus::NEGOTIATION)
                    ->count()
            )
                ->description('Deals under negotiation')
                ->descriptionIcon('heroicon-o-chat-bubble-left-right', IconPosition::Before)
                ->color('primary'),

            Stat::make(
                'Won',
                (clone $query)
                    ->where('status', LeadStatus::WON)
                    ->count()
            )
                ->description('Successfully closed')
                ->descriptionIcon('heroicon-o-trophy', IconPosition::Before)
                ->color('success'),

            Stat::make(
                'Lost',
                (clone $query)
                    ->where('status', LeadStatus::LOST)
                    ->count()
            )
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
