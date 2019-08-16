<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Common;

use App\AdminAccount;
use App\VolunteerAccount;
use App\Volunteer;
use App\Event;
use App\Programme;
use App\ProgrammeImage;
use App\InterestedProgramme;
use App\Officework;
use App\Notification;
use App\AwardHistory;
use App\Skillset;
use App\VolunteerEvent;
use App\VolunteerNotification;
use App\VolunteerOfficework;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
		Commands\Reminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
		$schedule->command("command:reminder")->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
