<?php

namespace App\Providers\Filament;

use App\Http\Middleware\AuthenticateFilament;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\EnsureActiveSubscription;
use App\Livewire\NotificationBell;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Vite;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->brandName('RealtyOS')
            ->brandLogo(asset('images/realtyos-logo.png'))
            ->brandLogoHeight('4rem')
            ->path('admin')
            ->login(false)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn() => new \Illuminate\Support\HtmlString(
                    '<script type="module" src="' . Vite::asset('resources/js/app.js') . '"></script>'
                ),
            )
            ->colors([
                'primary' => Color::Amber,
            ])

            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\\Filament\\Pages'
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\\Filament\\Widgets'
            )
            ->widgets([
                \App\Filament\Widgets\CompanyOverview::class,
                \App\Filament\Widgets\QuickActions::class,
                \App\Filament\Widgets\RecentProperties::class,
                \App\Filament\Widgets\RecentLeads::class,
                \App\Filament\Widgets\FollowUpStats::class,
                \App\Filament\Widgets\StatsOverview::class,
            ])
            ->renderHook(
                PanelsRenderHook::TOPBAR_END,
                fn() => view('filament.components.notification-bell'),
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                AuthenticateFilament::class,
                \App\Http\Middleware\EnsureEmailIsVerified::class,
                EnsureActiveSubscription::class,
            ]);
    }
}
