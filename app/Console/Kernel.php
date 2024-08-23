<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
      protected $commands = [
        \App\Console\Commands\CheckTaskNotifications::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tasks:check-notifications')->daily(); // or adjust as needed
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
