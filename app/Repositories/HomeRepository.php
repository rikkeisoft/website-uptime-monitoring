<?php
namespace App\Repositories;

use App\Models\AlertGroup;
use App\Models\AlertMethod;
use App\Models\Website;

class HomeRepository
{
    
    public static function  showItems()
    {
        $getAlertMethod = AlertMethod::all()->count();
        $getAlertGroup = AlertGroup::all()->count();
        $getWebsite = Website::all()->count();
        $getWebsiteUp = Website::where('status',2)->count();
        $data = [
            'alertgroup' => $getAlertGroup,
            'alertmethod' => $getAlertMethod,
            'website' => $getWebsite,
            'websiteup' => $getWebsiteUp
        ];
        if(empty($data)){
            return false;
        }
        return $data;
    }
}