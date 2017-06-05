<?php

namespace App\Http\Controllers;

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
     * AlertMethodAlertGroupController constructor.
     * @param AlertMethodAlertGroupRepository $alertMethodAlertGroupRepository
     * @param AlertGroupsRepository $alertGroupsRepository
     * @param AlertMethodsRepository $alertMethodsRepository
     */
    public function __construct(
        AlertMethodAlertGroupRepository $alertMethodAlertGroupRepository,
        AlertGroupsRepository $alertGroupsRepository,
        AlertMethodsRepository $alertMethodsRepository
    ) {
        $this->middleware('auth');
        $this->AlertMethodAlertGroupRepository = $alertMethodAlertGroupRepository;
        $this->AlertGroupsRepository = $alertGroupsRepository;
        $this->AlertMethodsRepository = $alertMethodsRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $alertMethodOfGroup = $this->AlertMethodAlertGroupRepository->all();
        return view('/alert-method-of-group.index')->with('alertMethodOfGroup', $alertMethodOfGroup);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $alertGroup = $this->AlertGroupsRepository->all();
        $alertMethod = $this->AlertMethodsRepository->all();
        return view('alert-method-of-group.create')->with([
            'alertGroup' => $alertGroup,
            'alertMethod' => $alertMethod
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->only('alert_method_id', 'alert_group_id');
        $alertMethodOfGroup = $this->AlertMethodAlertGroupRepository->create($data);
        if ($alertMethodOfGroup) {
            $request->session()->flash('alert-success', 'Add Success');
            return redirect('/alert-method-of-group');
        }
        $request->session()->flash('alert-error', 'Add Alert Method Of Group Error');
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(string $id)
    {
        $alertMethodOfGroup = $this->AlertMethodAlertGroupRepository->find($id);
        $alertGroup = $this->AlertGroupsRepository->all();
        $alertMethod = $this->AlertMethodsRepository->all();
        if (empty($alertMethodOfGroup)) {
            abort(404);
        }
        return view('/alert-method-of-group.edit')->with([
            'alertMethodOfGroup' => $alertMethodOfGroup,
            'alertGroup' => $alertGroup,
            'alertMethod' => $alertMethod
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, string $id)
    {
        $checkNullRequest = $request->input('alert_group_id');
        $checkNullRequest = $request->input('alert_method_id');
        //Check null data request
        if (empty($checkNullRequest)) {
            return redirect('/alert-method-of-group');
        }
        $data = $request->only('alert_group_id', 'alert_method_id');
        //Update
        $alertMethodOfGroup = $this->AlertMethodAlertGroupRepository->update($data, $id);
        if ($alertMethodOfGroup) {
            $request->session()->flash('alert-success', 'Update Success');
            return redirect('/alert-method-of-group');
        }
        $request->session()->flash('alert-error', 'Update Alert Method Of Group Error');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyMethodOfGroup(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $selectedIds = explode(",", $selectedIds);
        $alertMethodOfGroup = $this->AlertMethodAlertGroupRepository->delete($selectedIds);
        if ($alertMethodOfGroup > 0) {
            $request->session()->flash('alert-success', 'Delete Success');
            return redirect('/alert-method-of-group');
        }
        $request->session()->flash('alert-error', 'Delete Alert Method Of Group Error');
    }
}
