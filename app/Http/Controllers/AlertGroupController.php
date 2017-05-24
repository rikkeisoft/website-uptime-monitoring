<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlertGroupsRepository;
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
    public function index(){
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
     * @return string
     */
    public function destroy($id){
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
