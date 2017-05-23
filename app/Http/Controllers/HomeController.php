<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlertGroupsRepository as AlertGroup;

class HomeController extends Controller
{

    /**
     * @var Actor
     */
    private $actor;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AlertGroup $alertGroup)
    {
        $this->middleware('auth');

        $this->actor = $alertGroup;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alert = $this->actor->findAllBy('user_id', 'b00e35f0-92e6-4764-80af-b9dfcbff0cbf');

        dd($alert);

        return view('home');
    }
}
