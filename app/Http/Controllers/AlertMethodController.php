<?php
namespace App\Http\Controllers;

use App\Models\AlertMethod;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAlertMethodsRequest;
use App\Http\Requests\UpdateAlertMethodsRequest;
use App\Repositories\AlertMethodsRepository;
use Illuminate\Support\Facades\Auth;

class AlertMethodsController extends Controller
{

    private $alertMethodsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AlertMethodsRepository $alertMethodsRepository)
    {
        $this->middleware('auth');

        $this->alertMethodsRepository = $alertMethodsRepository;
    }

    /**
     * show list alert method
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $listType = AlertMethod::LIST_TYPE_ALERT_METHOD;

        $listAlertMethod = $this->alertMethodsRepository->all();

        return view('alertmethods.index', compact('listAlertMethod', 'listType'));
    }

    /**
     * show view add alert method
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $listType = AlertMethod::LIST_TYPE_ALERT_METHOD;

        return view('alertmethods.add', compact('listType'));
    }

    /**
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        $alertMethod = $this->alertMethodsRepository->find($id);

        $listType = AlertMethod::LIST_TYPE_ALERT_METHOD;

        return view('alertmethods.edit', compact('listType', 'alertMethod'));
    }

    /**
     * api add form add alert method
     * @param CreateAlertMethodsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAlertMethod(CreateAlertMethodsRequest $request)
    {

        $data = $request->only('name', 'type', 'email', 'phone_number', 'webhook');

        $data['user_id'] = Auth::user()->id;

        $createAlertMethod = $this->alertMethodsRepository->create($data);

        if ($createAlertMethod) {
            //messgae alert success
            $request->session()->flash('alert-success', 'Add Success');

            return redirect()->route('viewListAlertMethods');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Add Error');

            return redirect()->back();
        }
    }

    /**
     * @param UpdateAlertMethodsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAlertMethod(UpdateAlertMethodsRequest $request)
    {
        $data = $request->only('name', 'type', 'email', 'phone_number', 'webhook');

        $id = $request->input('id');

        $update = $this->alertMethodsRepository->update($data, $id);

        if ($update) {
            //messgae alert success
            $request->session()->flash('alert-success', 'Update Success');

            return redirect()->route('viewListAlertMethods');
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
        $data = $request->input('chkCat');

        $deleteAlertMethod = $this->alertMethodsRepository->delete($data);

        if ($deleteAlertMethod) {
            //messgae alert success
            $request->session()->flash('alert-success', 'Add Success');

            return redirect()->route('viewListAlertMethods');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Add Error');

            return redirect()->back();
        }

    }
}
