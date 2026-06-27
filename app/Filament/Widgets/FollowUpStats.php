<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FollowUpStats extends StatsOverviewWidget
{
protected function getStats(): array
{
    $user = auth()->user();

    $query = \App\Models\Lead::query()
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

        Stat::make('Overdue Follow Ups', $overdue)
            ->description('Need immediate attention')
            ->color('danger'),

        Stat::make('Today Follow Ups', $today)
            ->description('Scheduled for today')
            ->color('warning'),

        Stat::make('Upcoming Follow Ups', $upcoming)
            ->description('Future follow ups')
            ->color('success'),
    ];
}
}
