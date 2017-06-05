<?php
namespace App\Http\Controllers;

use App\Models\AlertMethod;
use App\Repositories\AlertGroupsRepository;
use App\Repositories\AlertMethodAlertGroupRepository;
use App\Repositories\MonitorRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAlertMethodsRequest;
use App\Http\Requests\UpdateAlertMethodsRequest;
use App\Repositories\AlertMethodsRepository;
use Illuminate\Support\Facades\Auth;

class AlertMethodsController extends Controller
{

    protected $alertMethodsRepository;

    protected $alertMethodAlertGroupRepository;

    protected $alertGroupsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        AlertMethodsRepository $alertMethodsRepository,
        AlertMethodAlertGroupRepository $alertMethodAlertGroupRepository,
        AlertGroupsRepository $alertGroupsRepository
    ) {
        
        $this->middleware('auth');
        $this->alertMethodsRepository = $alertMethodsRepository;
        $this->alertMethodAlertGroupRepository = $alertMethodAlertGroupRepository;
        $this->alertGroupsRepository = $alertGroupsRepository;
    }

    /**
     * show list alert method
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $listType = AlertMethod::LIST_TYPE_ALERT_METHOD;
        $listAlertMethod = $this->alertMethodsRepository->all();
        return view('alert-methods.index', compact('listAlertMethod', 'listType'));
    }

    /**
     * show view add alert method
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $listType = AlertMethod::LIST_TYPE_ALERT_METHOD;
        $listAlertGroup = $this->alertGroupsRepository->all();
        return view('alert-methods.create', compact('listType', 'listAlertGroup'));
    }

    /**
     * view update alert methods
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $id)
    {
        $alertMethod = $this->alertMethodsRepository->find($id);

        if (empty($alertMethod)) {
            abort(404);
        }
        $listAlertGroup = $this->alertGroupsRepository->all();
        $listType = AlertMethod::LIST_TYPE_ALERT_METHOD;
        return view('alert-methods.edit', compact('listType', 'alertMethod', 'listAlertGroup'));
    }

    public function show()
    {
    }

    /**
     * api add form add alert method
     * @param CreateAlertMethodsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAlertMethodsRequest $request)
    {
        $data = $request->only('name', 'type', 'email', 'phone_number', 'webhook');
        $data['user_id'] = Auth::user()->id;
        $createAlertMethod = $this->alertMethodsRepository->create($data);

        if ($createAlertMethod) {
            $dataAlertMethodGroup = $request->only('alert_group_id');
            $dataAlertMethodGroup['alert_method_id'] = $createAlertMethod->id;
            $createAlertMethodGroup = $this->alertMethodAlertGroupRepository->create($dataAlertMethodGroup);

            if ($createAlertMethodGroup) {
                $request->session()->flash('alert-success', 'Add Success');
            } else {
                $request->session()->flash('alert-error', 'Add Alert Method Alert Group Error');
            }
            return redirect()->route('alert-methods.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Add Error');
            return redirect()->back();
        }
    }

    /**
     * update alert methods post
     * @param UpdateAlertMethodsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAlertMethodsRequest $request, string $id)
    {
        $data = $request->only('name', 'type', 'email', 'phone_number', 'webhook');
        $update = $this->alertMethodsRepository->update($data, $id);

        if ($update) {
            $dataAlertMethodGroup = $request->only('alert_group_id');
            $dataAlertMethodGroupId = $update->alertmethodalertgroup->id;
            $updateMethodGroup = $this->alertMethodAlertGroupRepository
                ->update($dataAlertMethodGroup, $dataAlertMethodGroupId);

            if ($updateMethodGroup) {
                $request->session()->flash('alert-success', 'update Success');
            } else {
                $request->session()->flash('alert-error', 'update Alert Method Alert Group Error');
            }
            return redirect()->route('alert-methods.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Update Error');
            return redirect()->back();
        }
    }

    /**
     * delete alert method post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAlertMethods(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $selectedIds = explode(",", $selectedIds);

        if (empty($selectedIds)) {
            $request->session()->flash('alert-error', 'Add Error');
            return redirect()->back();
        }
        $deleteAlertMethod = $this->alertMethodsRepository->delete($selectedIds);

        if ($deleteAlertMethod) {
            //messgae alert success
            $request->session()->flash('alert-success', 'Deleted Success');
            return redirect()->route('alert-methods.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Deleted Error');
            return redirect()->back();
        }
    }
}
