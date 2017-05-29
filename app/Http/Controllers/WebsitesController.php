<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWebsitesRequest;
use App\Http\Requests\UpdateWebsitesRequest;
use App\Models\Website;
use App\Repositories\AlertGroupsRepository;
use App\Repositories\MonitorRepository;
use Illuminate\Http\Request;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Facades\Auth;

class WebsitesController extends Controller
{

    protected $websiteRepository,
        $monitorRepository,
        $alertGroupsRepository,
        $listStatus,
        $listFrequency,
        $listSensitivity;
    /**
     * WebsitesController constructor.
     * @param WebsiteRepository $websiteRepository
     */
    public function __construct(WebsiteRepository $websiteRepository, MonitorRepository $monitorRepository, AlertGroupsRepository $alertGroupsRepository)
    {
        $this->middleware('auth');

        $this->websiteRepository = $websiteRepository;

        $this->monitorRepository = $monitorRepository;

        $this->alertGroupsRepository = $alertGroupsRepository;

        $this->listFrequency = Website::LIST_FREQUENCY;

        $this->listSensitivity = Website::LIST_SENSITIVITY;

        $this->listStatus = Website::LIST_STATUS;
    }

    /**
     * view list website
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listWebsite = $this->websiteRepository->all();

        $listAlertGroup = $this->alertGroupsRepository->all();

        return view('websites.index')
            ->with([
                'listWebsite' => $listWebsite,
                'listFrequency' => $this->listFrequency,
                'listSensitivity' => $this->listSensitivity,
                'listStatus' => $this->listStatus,
                'listAlertGroup' => $listAlertGroup
            ]);
    }

    /**
     * view add website
     * @return \Illuminate\View\View
     */
    public function add()
    {
        $listFrequency = Website::LIST_FREQUENCY;

        $listSensitivity = Website::LIST_SENSITIVITY;

        $listStatus = Website::LIST_STATUS;

        $listAlertGroup = $this->alertGroupsRepository->all();

        return view('websites.add')
            ->with([
                'listFrequency' => $this->listFrequency,
                'listSensitivity' => $this->listSensitivity,
                'listStatus' => $this->listStatus,
                'listAlertGroup' => $listAlertGroup
            ]);
    }

    /**
     * view update website
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        $website = $this->websiteRepository->find($id);

        if (empty($website)) {
            abort(404);
        }

        $listFrequency = Website::LIST_FREQUENCY;

        $listSensitivity = Website::LIST_SENSITIVITY;

        $listStatus = Website::LIST_STATUS;

        $listAlertGroup = $this->alertGroupsRepository->all();

        return view('websites.update')
            ->with([
                'website' => $website,
                'listFrequency' => $this->listFrequency,
                'listSensitivity' => $this->listSensitivity,
                'listStatus' => $this->listStatus,
                'listAlertGroup' => $listAlertGroup
            ]);
    }

    /**
     * add new website post
     * @param AddWebsitesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addWebsite(AddWebsitesRequest $request)
    {

        $data = $request->only('url', 'name', 'sensitivity', 'status', 'frequency');

        $data['user_id'] = Auth::user()->id;

        $createWebsite = $this->websiteRepository->create($data);

        if ($createWebsite) {
            //create monitor with website
            $dataMonitor = $request->only('alert_group_id');
            $dataMonitor['website_id'] = $createWebsite->id;
            $dataMonitor['result'] = 2;

            $createMonitor = $this->monitorRepository->create($dataMonitor);

            if ($createMonitor) {
                $request->session()->flash('alert-success', 'Add Success');
            } else {
                $request->session()->flash('alert-error', 'Add Monitor Error');
            }

            return redirect()->route('viewListWebsite');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Add Error');

            return redirect()->back();
        }
    }

    /**
     * update wwebsite post
     * @param UpdateWebsitesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateWebsite(UpdateWebsitesRequest $request)
    {
        $data = $request->only('url', 'name', 'sensitivity', 'status', 'frequency');

        $id = $request->input('id');

        $update = $this->websiteRepository->update($data, $id);

        if ($update) {
            //update monitor with website
            $dataMonitor = $request->only('alert_group_id');
            $monitorId = $update->monitor->id;

            $updateMonitor = $this->monitorRepository->update($dataMonitor, $monitorId);

            if ($updateMonitor) {
                $request->session()->flash('alert-success', 'Update Success');
            } else {
                $request->session()->flash('alert-error', 'Update Monitor Error');
            }

            return redirect()->route('viewListWebsite');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Update Error');

            return redirect()->back();
        }
    }

    /**
     * delete website post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteWebsite(Request $request)
    {
        $data = $request->input('chkCat');

        $deleteWebsite = $this->websiteRepository->delete($data);

        if ($deleteWebsite) {
            //messgae alert success
            $request->session()->flash('alert-success', 'Add Success');

            return redirect()->route('viewListWebsite');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Add Error');

            return redirect()->back();
        }
    }

    /**
     * set enable or disable website
     * @param Request $request
     * @return json
     */
    public function setEnableDisable(Request $request)
    {
        $status = $request->input('status');

        if ($status == 1) {
            $data = [
                'status' => 2
            ];
        } else {
            $data = [
                'status' => 1
            ];
        }

        $id = $request->input('id');

        $update = $this->websiteRepository->update($data, $id);

        $listStatus = Website::LIST_STATUS;

        if (isset($update->id)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }
    }
}
