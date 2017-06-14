<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;
use App\Contracts\DBTable;
use App\Console\Commands\CheckWebsite;
use App\Models\Website;
use App\Repositories\WebsiteRepository;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        if (Schema::hasTable(DBTable::WEBSITE)) {
            $websites = $this->getAllWebsite();

            foreach ($websites as $website) {
                $schedule->call(function () use ($website) {
                    new CheckWebsite($website);
                })->cron("*/{$website->frequency} * * * * *");
            }
        }
    }

    /**
     * Retrieve all enabled Websites.
     *
     * @return array
     */
    public function getEnabledWebsites()
    {
        return app(WebsiteRepository::class)->findAllBy('status', Website::STATUS_ENABLED);
    }
}
