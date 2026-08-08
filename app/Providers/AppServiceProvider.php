<?php

namespace App\Providers;

use App\Filament\Auth\LogoutResponse;
use App\Models\Lead;
use App\Models\Property;
use App\Observers\LeadObserver;
use App\Observers\PropertyObserver;
use App\Observers\UserObserver;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            LogoutResponseContract::class,
            LogoutResponse::class,
        );
    }

    public function boot(): void
    {
        Lead::observe(LeadObserver::class);
        Property::observe(PropertyObserver::class);
        User::observe(UserObserver::class);
    }
}