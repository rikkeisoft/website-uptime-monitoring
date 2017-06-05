<?php

namespace App\Http\Controllers;

use App\Contracts\Constants;
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
        $alertGroupsRepository;
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
    }

    /**
     * view list website
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listWebsite = $this->websiteRepository->paginate(Constants::LIMIT_PAGINATE);
        $listAlertGroup = $this->alertGroupsRepository->all();
        return view('websites.index')
            ->with([
                'listWebsites' => $listWebsite,
                'listFrequencys' => Website::LIST_FREQUENCYS,
                'listSensitivitys' => Website::LIST_SENSITIVITYS,
                'listStatus' => Website::LIST_STATUS,
                'listAlertGroup' => $listAlertGroup
            ]);
    }

    /**
     * view add website
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $listAlertGroup = $this->alertGroupsRepository->all();
        return view('websites.create')
            ->with([
                'listFrequencys' => Website::LIST_FREQUENCYS,
                'listSensitivitys' => Website::LIST_SENSITIVITYS,
                'listStatus' => Website::LIST_STATUS,
                'listAlertGroup' => $listAlertGroup
            ]);
    }

    public function show()
    {

    }

    /**
     * view update website
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $id)
    {
        $website = $this->websiteRepository->find($id);
        if (empty($website)) {
            abort(404);
        }
        $listAlertGroup = $this->alertGroupsRepository->all();

        return view('websites.edit')
            ->with([
                'website' => $website,
                'listFrequencys' => Website::LIST_FREQUENCYS,
                'listSensitivitys' => Website::LIST_SENSITIVITYS,
                'listStatus' => Website::LIST_STATUS,
                'listAlertGroup' => $listAlertGroup
            ]);
    }

    /**
     * add new website post
     * @param AddWebsitesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddWebsitesRequest $request)
    {
        $data = $request->only('url', 'name', 'sensitivity', 'status', 'frequency');
        $data['user_id'] = Auth::user()->id;
        $createWebsite = $this->websiteRepository->create($data);

        if ($createWebsite) {
            //create monitor with website
            $dataMonitor = $request->only('alert_group_id');
            $dataMonitor['website_id'] = $createWebsite->id;
            $dataMonitor['result'] = Constants::CHECK_FAILED;
            $createMonitor = $this->monitorRepository->create($dataMonitor);

            if ($createMonitor) {
                $request->session()->flash('alert-success', 'Add Successfully');
            } else {
                $request->session()->flash('alert-error', 'Add Monitor Error');
            }
            return redirect()->route('websites.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Add Error');
            return redirect()->back();
        }
    }

    /**
     * update website post
     * @param UpdateWebsitesRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWebsitesRequest $request, string $id)
    {
        $data = $request->only('url', 'name', 'sensitivity', 'status', 'frequency');
        $update = $this->websiteRepository->update($data, $id);

        if ($update) {
            //update monitor with website
            $dataMonitor = $request->only('alert_group_id');
            $monitorId = $update->monitor->id;
            $updateMonitor = $this->monitorRepository->update($dataMonitor, $monitorId);

            if ($updateMonitor) {
                $request->session()->flash('alert-success', 'Update Successfully');
            } else {
                $request->session()->flash('alert-error', 'Update Monitor Error');
            }
            return redirect()->route('websites.index');
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
    public function destroy(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $selectedIds = explode(",", $selectedIds);

        if(empty($selectedIds)) {
            $request->session()->flash('alert-error', 'Add Error');
            return redirect()->back();
        }
        $deleteWebsite = $this->websiteRepository->delete($selectedIds);

        if ($deleteWebsite) {
            //messgae alert success
            $request->session()->flash('alert-success', 'Delete Successfully');
            return redirect()->route('websites.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Delete Error');
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
        $status == Website::STATUS_ENABLED ? $check = Website::STATUS_DISABLED : $check = Website::STATUS_ENABLED;
        $data = [
            'status' => $check
        ];

        $id = $request->input('id');
        $update = $this->websiteRepository->update($data, $id);

        if (isset($update->id)) {
            return json_encode(['success' => true]);
        } else {
            return json_encode(['success' => false]);
        }
    }
}
