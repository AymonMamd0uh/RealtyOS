<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {

        $user = auth()->user();

        // Platform Admin
        if ($user->hasRole('Platform Admin')) {
            return [
                Stat::make('Companies', Company::count()),
                Stat::make('Users', User::count()),
                Stat::make('Properties', Property::count()),
                Stat::make('Leads', Lead::count()),
            ];
        }

        // Agent
        if ($user->hasRole('Agent')) {
            return [
                Stat::make(
                    'My Properties',
                    Property::where('user_id', $user->id)->count()
                ),

                Stat::make(
                    'My Leads',
                    Lead::where('assigned_to', $user->id)->count()
                ),
            ];
        }

        // Owner / Super Admin / Manager
        return [
            Stat::make(
                'Users',
                User::where('company_id', $user->company_id)->count()
            ),

            Stat::make(
                'Properties',
                Property::where('company_id', $user->company_id)->count()
            ),

            Stat::make(
                'Leads',
                Lead::where('company_id', $user->company_id)->count()
            ),
        ];
    }
}
