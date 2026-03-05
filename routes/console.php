<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('quotes:mark-abandoned')->daily();
Schedule::command('leads:check-followups')->hourly();
Schedule::command('report:monthly', ['--email'])->monthlyOn(1, '06:00');
