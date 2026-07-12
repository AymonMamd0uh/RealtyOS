<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FollowUpStats extends StatsOverviewWidget
{
    protected static ?int $sort = 2;
protected int|string|array $columnSpan = 'full';
    protected function getStats(): array
    {
        $user = auth()->user();

        $query = Lead::query()
            ->where('follow_up_completed', false)
            ->whereNotNull('next_follow_up_at');

        if ($user->hasRole('Agent')) {
            $query->where('assigned_to', $user->id);
        } elseif (! $user->hasRole('Platform Admin')) {
            $query->where('company_id', $user->company_id);
        }

        $overdue = (clone $query)
            ->where('next_follow_up_at', '<', now())
            ->count();

        $today = (clone $query)
            ->whereDate('next_follow_up_at', today())
            ->count();

        $upcoming = (clone $query)
            ->where('next_follow_up_at', '>', now())
            ->count();

        return [

            Stat::make('Overdue', $overdue)
                ->description('Requires immediate action')
                ->descriptionIcon('heroicon-o-exclamation-triangle', IconPosition::Before)
                ->color($overdue > 0 ? 'danger' : 'success'),

            Stat::make('Today', $today)
                ->description('Scheduled for today')
                ->descriptionIcon('heroicon-o-calendar-days', IconPosition::Before)
                ->color('warning'),

            Stat::make('Upcoming', $upcoming)
                ->description('Scheduled for upcoming days')
                ->descriptionIcon('heroicon-o-clock', IconPosition::Before)
                ->color('primary'),

        ];
    }

    public static function canView(): bool
    {
        return auth()->check();
    }
}