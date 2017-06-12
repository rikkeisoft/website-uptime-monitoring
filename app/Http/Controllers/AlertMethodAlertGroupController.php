<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AlertMethodAlertGroupRepository;
use App\Repositories\AlertGroupsRepository;
use App\Repositories\AlertMethodsRepository;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

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
        $this->alertMethodAlertGroupRepository = $alertMethodAlertGroupRepository;
        $this->alertGroupsRepository = $alertGroupsRepository;
        $this->alertMethodsRepository = $alertMethodsRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('/alert-method-of-group.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $alertGroup = $this->alertGroupsRepository->all();
        $alertMethod = $this->alertMethodsRepository->all();

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
        $alertMethodOfGroup = $this->alertMethodAlertGroupRepository->create($data);
        if ($alertMethodOfGroup) {
            $request->session()->flash('alert-success', 'Add Alert Method Of Group Successfully');

            return redirect('/alert-method-of-group');
        }
        $request->session()->flash('alert-error', 'Add Alert Method Of Group Failed');
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(string $id)
    {
        $alertMethodOfGroup = $this->alertMethodAlertGroupRepository->find($id);
        $alertGroup = $this->alertGroupsRepository->all();
        $alertMethod = $this->alertMethodsRepository->all();
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
        $alertMethodOfGroup = $this->alertMethodAlertGroupRepository->update($data, $id);
        if ($alertMethodOfGroup) {
            $request->session()->flash('alert-success', 'Update Alert Method Of Group Successfully');

            return redirect('/alert-method-of-group');
        }
        $request->session()->flash('alert-error', 'Update Alert Method Of Group Failed');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $selectedIds = explode(',', $selectedIds);
        $alertMethodOfGroup = $this->alertMethodAlertGroupRepository->delete($selectedIds);
        if ($alertMethodOfGroup > 0) {
            $request->session()->flash('alert-success', 'Delete Alert Method Of Group Successfully');

            return redirect('/alert-method-of-group');
        }
        $request->session()->flash('alert-error', 'Delete Alert Method Of Group Failed');
    }

    /**
     * @param Datatables $datatables
     * @return mixed
     */
    public function searchAlertMethodOfGroup(Datatables $datatables)
    {
        $user_id = Auth::user()->id;
        $result = $this->alertMethodAlertGroupRepository->searchAlertMethodOfGroup($user_id);
        return Datatables::of($result)
            ->rawColumns([5])
            ->make(true);
    }
}
