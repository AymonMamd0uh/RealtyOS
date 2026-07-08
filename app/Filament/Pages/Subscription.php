<?php

namespace App\Filament\Pages;

use App\Models\Plan;
use Filament\Pages\Page;

class Subscription extends Page
{
    protected static ?string $navigationLabel = 'Subscription';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.subscription';

    public $subscription;

    public $currentPlan;

    public int $daysRemaining = 0;

    public int $usersCount = 0;

    public int $propertiesCount = 0;

    public function mount(): void
    {
        $company = auth()->user()->company;

        $this->subscription = $company->activeSubscription;

        $this->currentPlan = $this->subscription?->plan;

        if ($this->subscription?->trial_ends_at) {
            $this->daysRemaining = max(
                0,
                now()->startOfDay()->diffInDays(
                    $this->subscription->trial_ends_at->startOfDay(),
                    false
                )
            );
        }

        $this->usersCount = $company->users()->count();

        $this->propertiesCount = $company->properties()->count();
    }

    public function plans()
    {
        return Plan::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }
}