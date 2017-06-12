<?php

namespace App\Console;

use App\Contracts\DBTable;
use DB;
use App\Console\Commands\CheckWebsite;
use App\Repositories\WebsiteRepository;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    protected $website;

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        if (Schema::hasTable(DBTable::WEBSITE)) {
            //get website from database
            $this->website = $this->getAllWebsite();

            foreach ($this->website as $website) {
                $schedule->call(function () use ($website) {
                    new CheckWebsite($website);
                })->cron('*/'.$website->frequency.' * * * * *');
            }
        }
    }

    /**
     * get all website enable
     * @return array
     */
    public function getAllWebsite()
    {
        return app(WebsiteRepository::class)->findAllBy('status', 1);
    }
}