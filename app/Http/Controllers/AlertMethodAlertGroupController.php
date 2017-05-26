<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlertMethodAlertGroupRepository;

class AlertMethodAlertGroupController extends Controller
{
    private $alertMethodAlertGroupRepository;
    /**
     * AlertMethodAlertGroup constructor.
     * @param AlertMethodAlertGroupRepository $alertMethodAlertGroupRepository
     */
    public function __construct(alertMethodAlertGroupRepository $alertMethodAlertGroupRepository)
    {
        $this->middleware('auth');
        $this->alertMethodAlertGroupRepository = $alertMethodAlertGroupRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->alertMethodAlertGroupRepository->all();
        if (empty($result)){
            return false;
        }
        return view('alert-method-alert-group.index')->with('items',$result);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAlertMethodAlertGroup(Request $request)
    {
        $data = $request->input('chkCat');
        if (empty($data)){
            return false;
        }
        $result = $this->alertMethodAlertGroupRepository->delete($data);
        return redirect('/alert-method-alert-group');
    }
}
