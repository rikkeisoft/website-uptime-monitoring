<?php

namespace App\Http\Controllers;

use App\Repositories\HomeRepository;

class HomeController extends Controller
{  
    protected  $HomeRepository;

   public function __construct()
    {  
        $this->middleware('auth');
        $this->HomeRepository = new HomeRepository();
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    
     /**
     * Show the alert group in dashboard.
     */
    public function showItems()
    {
        $result = $this->HomeRepository->showItems();
        if($result === false) {
            return 'Error';
        }
        return view('admin.dashboard')->with([
             'alertgroup' => $result['alertgroup'],
             'alertmethod' => $result['alertmethod'],
             'website' => $result['website'],
             'websiteup' => $result['websiteup']
        ]);
    }
 
}
