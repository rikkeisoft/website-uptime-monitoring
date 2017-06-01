<?php

namespace App\Http\Controllers;

use App\Repositories\AlertGroupsRepository;
use Auth;
use App\Http\Requests\AlertGroupRequest;
use Illuminate\Http\Request;

class AlertGroupController extends Controller
{
    private $alertGroupsRepository;

    public function __construct(AlertGroupsRepository $alertGroupsRepository)
    {
        $this->middleware('auth');
        $this->alertGroupsRepository = $alertGroupsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $alertGroups = $this->alertGroupsRepository->all();
        return view('alert-group.index')->with('alertGroups', $alertGroups);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $id
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(string $id)
    {
        $alertGroup = $this->alertGroupsRepository->find($id);
        if (empty($alertGroup)) {
            return redirect('/error-edit-AlertGroup');
        }
        return view('alert-group.edit')->with('alertGroup', $alertGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\AlertGroupRequest $request
     * @param string $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(AlertGroupRequest $request, string $id)
    {
        $data = $request->only('name');
        $alertGroup = $this->alertGroupsRepository->update($data, $id);
        if ($alertGroup) {
            return redirect('/alert-group');
        }
        return redirect('/error-edit-AlertGroup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('alert-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AlertGroupRequest $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(AlertGroupRequest $request)
    {
        $data = $request->only('name');
        $data['user_id'] = Auth::user()->id;
        $created = $this->alertGroupsRepository->create($data);
        if ($created) {
            return redirect('/alert-group');
        }
        return redirect('/error-create-AlertGroup');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroyAlertGroup(Request $request)
    {
        $alertGroupIds = $request->input('alertGroupIds');
        $numDeleted = $this->alertGroupsRepository->delete($alertGroupIds);
        if ($numDeleted > 0) {
            return redirect('/alert-group');
        }
        return redirect('/error-delete-AlertGroup');
    }
    public function show()
    {

    }

}
