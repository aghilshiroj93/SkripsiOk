<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // ✅ Jalankan command absensi otomatis setiap hari jam 14:00
        $schedule->command('absensi:kirim-notifikasi')->dailyAt('16:00');

        $schedule->command('notifikasi:alpha3')->dailyAt('16:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
    protected $commands = [
        \App\Console\Commands\KirimNotifikasiAlpha::class,
    ];
}
