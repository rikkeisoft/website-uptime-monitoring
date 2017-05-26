<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\AlertMethodAlertGroupRepository;
use App\Repositories\AlertGroupsRepository;
use App\Repositories\AlertMethodsRepository;

class AlertMethodAlertGroupController extends Controller
{
    private $alertMethodAlertGroupRepository;
    private $alertGroupsRepository;
    private $alertMethodsRepository;
    /**
     * AlertMethodAlertGroup constructor.
     * @param AlertMethodAlertGroupRepository $alertMethodAlertGroupRepository
     */
    public function __construct(alertMethodAlertGroupRepository $alertMethodAlertGroupRepository,alertGroupsRepository $alertGroupsRepository, alertMethodsRepository $alertMethodsRepository)
    {
        $this->middleware('auth');
        $this->alertMethodAlertGroupRepository = $alertMethodAlertGroupRepository;
        $this->alertGroupsRepository = $alertGroupsRepository;
        $this->alertMethodsRepository = $alertMethodsRepository;
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
        return view('/alert-method-of-group.index')->with('items',$result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $alertGroup = $this->alertGroupsRepository->all();
        $alertMethod = $this->alertMethodsRepository->all();

        if (empty($alertGroup && $alertMethod)){
            return false;
        }
        return view('alert-method-of-group.create')->with([
            'alertgroups' => $alertGroup,
            'alertmethods' => $alertMethod
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('alert_method_id','alert_group_id');
        if (empty($data)){
            return false;
        }
        $result = $this->alertMethodAlertGroupRepository->create($data);
        return redirect('/alert-method-of-group');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $result = $this->alertMethodAlertGroupRepository->find($id);
        $alertGroup = $this->alertGroupsRepository->all();
        $alertMethod = $this->alertMethodsRepository->all();
        if (empty($result)){
            return 'Error';
        }
        return view('/alert-method-of-group.edit')->with([
            'items' => $result,
            'alertgroups' => $alertGroup,
            'alertmethods' => $alertMethod
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMethodofGroup(Request $request)
    {
        //Get reruest submit
        $checkRequest = $request->input('alert_group_id');
        $checkRequest = $request->input('alert_method_id');
        $data = $request->only('alert_group_id','alert_method_id');
        $id = $request->input('id');

        // Check request null
        if (empty($checkRequest)){
            return redirect('/alert-method-of-group');
        }
        // Update
        $result = $this->alertMethodAlertGroupRepository->update($data,$id);
        return redirect('/alert-method-of-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMethodofGroup(Request $request)
    {
        $data = $request->input('chkCat');
        if (empty($data)){
            return false;
        }
        $result = $this->alertMethodAlertGroupRepository->delete($data);
        return redirect('/alert-method-of-group');
    }
}
