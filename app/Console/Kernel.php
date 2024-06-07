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
        // Ejecutar el comando `backup:clean` cada 7 días a las 2:00 PM
        $schedule->command('backup:clean')->cron('0 14 */7 * *');
        // Ejecutar el comando `backup:run` cada 7 días a las 2:00 PM
        $schedule->command('backup:run --only-db')->cron('0 14 */7 * *');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
