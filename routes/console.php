<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('ofensivas:verificar')->weeklyOn(1, '00:01');

Schedule::command('tokens:renovar')->dailyAt('00:00');
