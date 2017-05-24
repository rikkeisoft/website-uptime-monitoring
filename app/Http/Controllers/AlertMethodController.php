<?php
namespace App\Http\Controllers;

use App\Models\AlertMethod;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAlertMethodsRequest;
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
        return view('alertmethods.index');
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
            $request->session()->flash('alert-error', 'Add Error');

            return redirect()->back();
        }
    }
}
