<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// untuk production
Schedule::command('membership:check')
    ->daily()
    ->at('00:00')
    ->timezone('Asia/Jakarta')
    ->withoutOverlapping()
    ->onOneServer() // run on one server to avoid duplicate job execution
    ->evenInMaintenanceMode(); // run even in maintenance mode

    // kita setting untuk jalankan setiap hari jam 00:00 di time zone jakarta
    // kenapa pake timezone jakarta? karena server kita ada di indonesia
    // dan kita ingin jalankan job ini setiap hari jam 00:00 pagi
    // jadi kita set timezone menjadi jakarta agar waktu yang dijalankan sesuai dengan waktu di indonesia
    // kenapa pake withoutOverlapping? karena kita tidak ingin job ini dijalankan 2x dalam satu waktu
    // jadi kita set withoutOverlapping agar job ini hanya dijalankan 1x dalam satu waktu
    // dan kenapa pake onOneServer? karena kita ingin job ini hanya dijalankan di satu server saja
    // jadi kita set onOneServer agar job ini hanya dijalankan di satu server yang kita inginkan
    // kenapa pake evenInMaintenanceMode? karena kita ingin job ini tetap jalan walaupun server dalam mode maintenance


// untuk local (uji coba)
// Schedule::command('membership:check')->everyMinute();