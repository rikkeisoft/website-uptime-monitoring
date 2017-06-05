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
            abort(404);
        }
        return view('alert-group.edit')->with('alertGroup', $alertGroup);
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\AlertGroupRequest $request
     * @param string $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(AlertGroupRequest $request, string $id)
    {
        $data = $request->only('name');
        $alertGroup = $this->alertGroupsRepository->update($data, $id);
        if ($alertGroup) {
            $request->session()->flash('alert-success', 'Update  Successfully');
            return redirect('/alert-group');
        }
        $request->session()->flash('alert-error', 'Update Alert Group Failed');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('alert-group.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\AlertGroupRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(AlertGroupRequest $request)
    {
        $data = $request->only('name');
        $data['user_id'] = Auth::user()->id;
        $created = $this->alertGroupsRepository->create($data);
        if ($created) {
            $request->session()->flash('alert-success', 'Add Alert Group Successfully');
            return redirect('/alert-group');
        }
        $request->session()->flash('alert-error', 'Add Alert Group Failed');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $selectedIds = explode(',', $selectedIds);
        $numDeleted = $this->alertGroupsRepository->delete($selectedIds);
        if ($numDeleted > 0) {
            $request->session()->flash('alert-success', 'Delete Alert Group Successfully');
            return redirect('/alert-group');
        }
        $request->session()->flash('alert-error', 'Delete Alert Group Failed');
    }
}
