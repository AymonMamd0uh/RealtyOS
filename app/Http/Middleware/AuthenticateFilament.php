<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as Middleware;

class AuthenticateFilament extends Middleware
{
    protected function getRedirectTo($request): ?string
    {
        return route('login');
    }
}