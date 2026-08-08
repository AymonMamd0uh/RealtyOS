<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Notifications extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bell';
    protected static ?string $navigationLabel = 'Notifications';

    protected static ?string $title = 'Notifications';

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.notifications';
}
