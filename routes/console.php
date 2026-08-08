<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('notifications:followups-due')
    ->everyMinute();
Schedule::command('notifications:followups-overdue')
    ->everyMinute();
Schedule::command('notifications:subscriptions-expiring')
    ->dailyAt('09:00');

Schedule::command('notifications:subscriptions-expired')
    ->dailyAt('09:05');