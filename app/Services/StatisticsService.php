<?php

namespace App\Services;

use App\Models\AlertGroup;
use App\Models\AlertMethod;
use App\Models\Website;

class StatisticsService
{
    public static function showStatistics()
    {
        $alertMethods = AlertMethod::count();
        $alertGroups = AlertGroup::count();
        $websites = Website::count();
        $upWebsites = Website::where('status', Website::STATUS_ENABLED)->count();
        
        return [
            'alert_methods' => $alertMethods,
            'alert_groups' => $alertGroups,
            'websites' => $websites,
            'up_websites' => $upWebsites
        ];
    }
}


