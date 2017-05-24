<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;

class HomeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
     /**
     * Show the alert group in dashboard.
     */
    public function showStatistics()
    {
        $result = StatisticsService::showStatistics();

        return view('admin.dashboard')->with([
             'alert_groups' => $result['alert_groups'],
             'alert_methods' => $result['alert_methods'],
             'websites' => $result['websites'],
             'up_websites' => $result['up_websites']
        ]);
    }
 
}
