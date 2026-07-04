<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;
use App\Filament\Auth\LogoutResponse;
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
    }
}