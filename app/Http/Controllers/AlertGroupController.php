<?php

namespace App\Http\Controllers;


use App\Repositories\AlertGroupsRepository;
use Auth;
use App\Http\Requests\AlertGroupRequest;

class AlertGroupController extends Controller
{
    private $alertGroupsRepository;

    public function __construct(alertGroupsRepository $alertGroupsRepository )
    {
        $this->middleware('auth');
        $this->alertGroupsRepository = $alertGroupsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->alertGroupsRepository->all();
        if (empty($result)){
            return false;
        }
        return view('alert-group.index')->with('items',$result);
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
        $result = $this->alertGroupsRepository->find($id);
        if (empty($result)){
            return 'Error';
        }
        return view('alert-group.edit')->with('items',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlertGroupRequest $request, $id)
    {
     $data = $this->alertGroupsRepository->find($id);
     $data = $request->input('name');
     dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alert-group.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function store(AlertGroupRequest $request)
    {
        $data = $request->only('name');
        $data['user_id'] = Auth::user()->id;
        if (empty($data)){
            return false;
        }
        $result = $this->alertGroupsRepository->create($data);
        return redirect('/alert-group');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        if (!$id){
            return false;
        }
        $result = $this->alertGroupsRepository->delete($id);
        if ($result === false){
            return "deleted false";
        }
        return redirect('/alert-group');
    }

}