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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $tasks = $this->getNextTasks(2);

            if (!empty($tasks)) {
                ProcessTasksJob::dispatch($tasks);
            }
        })->everyFiveSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    private function getNextTasks(int $count): array
    {
        // Örneğin görevler bir veritabanından alınıyor
        return \App\Models\Task::where('status', 'pending')
            ->take($count)
            ->pluck('id')
            ->toArray();
    }
}
