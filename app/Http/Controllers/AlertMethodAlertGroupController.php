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
        return view('/alert-method-of-group.index')->with('alertMethodOfGroups', $alertMethodOfGroup);
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
            return redirect('/alert-method-of-group');
        }
        return redirect('/error-create-alertMethodOfGroup');
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
            return redirect('/error-edit-alertMethodOfGroup');
        }
        return view('/alert-method-of-group.edit')->with([
            'alertMethodOfGroups' => $alertMethodOfGroup,
            'alertGroups' => $alertGroup,
            'alertMethods' => $alertMethod
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
            return redirect('/alert-method-of-group');
        }
        return redirect('/error-edit-alertMethodOfGroup');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyMethodOfGroup(Request $request)
    {
        $data = $request->input('selectedIds');
        if (empty($data)) {
            return redirect('/error-delete-alertMethodOfGroup');
        }
        $alertMethodOfGroup = $this->AlertMethodAlertGroupRepository->delete($data);
        if ($alertMethodOfGroup > 0) {
            return redirect('/alert-method-of-group');
        }
        return redirect('/error-delete-alertMethodOfGroup');
    }
}
