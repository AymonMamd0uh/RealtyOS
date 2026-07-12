<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Platform Admin
        |--------------------------------------------------------------------------
        */

        if ($user->hasRole('Platform Admin')) {

            return [

                Stat::make('Companies', Company::count())
                    ->description('Registered companies')
                    ->descriptionIcon('heroicon-m-building-office-2', IconPosition::Before)
                    ->color('primary')
                    ->chart([7, 10, 8, 12, 15, 18, 22]),

                Stat::make('Users', User::count())
                    ->description('Registered users')
                    ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                    ->color('success')
                    ->chart([3, 5, 7, 10, 12, 15, 18]),

                Stat::make('Properties', Property::count())
                    ->description('Total properties')
                    ->descriptionIcon('heroicon-m-home', IconPosition::Before)
                    ->color('warning')
                    ->chart([5, 6, 8, 10, 12, 14, 16]),

                Stat::make('Leads', Lead::count())
                    ->description('Total leads')
                    ->descriptionIcon('heroicon-m-user-plus', IconPosition::Before)
                    ->color('danger')
                    ->chart([2, 4, 6, 8, 10, 13, 15]),

            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Agent
        |--------------------------------------------------------------------------
        */

        if ($user->hasRole('Agent')) {

            return [

                Stat::make(
                    'My Properties',
                    Property::where('user_id', $user->id)->count()
                )
                    ->description('Assigned properties')
                    ->descriptionIcon('heroicon-m-home', IconPosition::Before)
                    ->color('primary'),

                Stat::make(
                    'My Leads',
                    Lead::where('assigned_to', $user->id)->count()
                )
                    ->description('Assigned leads')
                    ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                    ->color('success'),

            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Owner
        |--------------------------------------------------------------------------
        */

        return [

            Stat::make(
                'Users',
                User::where('company_id', $user->company_id)->count()
            )
                ->description('Company users')
                ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                ->color('primary')
                ->chart([5, 6, 7, 8, 9, 10, 12]),

            Stat::make(
                'Properties',
                Property::where('company_id', $user->company_id)->count()
            )
                ->description('Company properties')
                ->descriptionIcon('heroicon-m-home-modern', IconPosition::Before)
                ->color('warning')
                ->chart([3, 5, 8, 10, 12, 15, 18]),

            Stat::make(
                'Leads',
                Lead::where('company_id', $user->company_id)->count()
            )
                ->description('Company leads')
                ->descriptionIcon('heroicon-m-user-plus', IconPosition::Before)
                ->color('success')
                ->chart([2, 4, 6, 7, 8, 9, 10]),

        ];
    }
}
