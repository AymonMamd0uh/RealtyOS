<?php

namespace App\Filament\Pages;

use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Filament\Pages\Page;

class Reports extends Page
{
    protected static ?string $navigationLabel = 'Reports';

    protected static string|\UnitEnum|null $navigationGroup = 'Reports';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.reports';
    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole([
            'Platform Admin',
            'Owner',
            'Super Admin',
            'Manager',
        ]);
    }
    public $totalLeads;
    public $wonLeads;
    public $lostLeads;
    public $conversionRate;

    public $totalProperties;
    public $availableProperties;
    public $soldProperties;

    public $totalAgents;

    public function mount(): void
    {
        $user = auth()->user();

        $leadQuery = Lead::query();
        $propertyQuery = Property::query();
        $agentQuery = User::role('Agent');

        if (! $user->hasRole('Platform Admin')) {
            $leadQuery->where('company_id', $user->company_id);
            $propertyQuery->where('company_id', $user->company_id);
            $agentQuery->where('company_id', $user->company_id);
        }

        $this->totalLeads = (clone $leadQuery)->count();

        $this->wonLeads = (clone $leadQuery)
            ->where('status', 'won')
            ->count();

        $this->lostLeads = (clone $leadQuery)
            ->where('status', 'lost')
            ->count();

        $this->conversionRate = $this->totalLeads > 0
            ? round(($this->wonLeads / $this->totalLeads) * 100, 2)
            : 0;

        $this->totalProperties = (clone $propertyQuery)->count();

        $this->availableProperties = (clone $propertyQuery)
            ->where('status', 'available')
            ->count();

        $this->soldProperties = (clone $propertyQuery)
            ->where('status', 'sold')
            ->count();

        $this->totalAgents = (clone $agentQuery)->count();
    }
}
