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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class WebsitesController extends Controller
{

    protected $websiteRepository;
    protected $monitorRepository;
    protected $alertGroupsRepository;
    /**
     * WebsitesController constructor.
     * @param WebsiteRepository $websiteRepository
     */
    public function __construct(
        WebsiteRepository $websiteRepository,
        MonitorRepository $monitorRepository,
        AlertGroupsRepository $alertGroupsRepository
    ) {
    
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
                'listResults' => Website::LIST_RESULTS,
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

    public function statistic(string $website_id)
    {
        $listRequest = [];
        $listUpDown = [];
        $listCreated = [];
        $webSite = $this->websiteRepository->find($website_id);
        $websiteName = $webSite['name'];
        try {
            $key = "statistic_{$website_id}";
            $redis = Redis::connection();
            $listLength = $redis->llen($key);
            //Get list status website
            $listStatusWebsite = $redis->lrange($key, $listLength - Constants::LIMIT_LIST_REDIS, $listLength);
            if (!empty($listStatusWebsite)) {
                $checkFail = 0;
                $checkSuccess = 0;
                foreach ($listStatusWebsite as $status) {
                    $status = json_decode($status);
                    array_push($listRequest, $status->time_request);
                    array_push($listCreated, $status->created_at);
                    if ($status->success == Constants::CHECK_FAILED) {
                        $checkFail++;
                    } else {
                        $checkSuccess++;
                    }
                    $listUpDown['fail'] = $checkFail;
                    $listUpDown['success'] = $checkSuccess;
                }
            }
        } catch (\Exception $e) {
            Log::info('redis error : '.$e);
        }
        return view('websites.statistic')
            ->with([
                'listRequest' => $listRequest,
                'listUpDown' => $listUpDown,
                'listCreated' => implode('|', $listCreated),
                'websiteName' => $websiteName
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
            $dataMonitor['result'] = Constants::CHECK_PENDING;
            $createMonitor = $this->monitorRepository->create($dataMonitor);

            if ($createMonitor) {
                $request->session()->flash('alert-success', 'Add Websites Successfully');
            } else {
                $request->session()->flash('alert-error', 'Add Monitor Websites Failed');
            }
            return redirect()->route('websites.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Add Websites Failed');
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
            $monitorId = $update->monitor->first()->id;
            $updateMonitor = $this->monitorRepository->update($dataMonitor, $monitorId);

            if ($updateMonitor) {
                $request->session()->flash('alert-success', 'Update Websites Successfully');
            } else {
                $request->session()->flash('alert-error', 'Update Monitor Websites Failed');
            }
            return redirect()->route('websites.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Update Websites Failed');
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

        if (empty($selectedIds)) {
            $request->session()->flash('alert-error', 'Delete Websites Failed');
            return redirect()->back();
        }
        $deleteWebsite = $this->websiteRepository->delete($selectedIds);

        if ($deleteWebsite) {
            //messgae alert success
            $request->session()->flash('alert-success', 'Delete Websites Successfully');
            return redirect()->route('websites.index');
        } else {
            //message alsert error
            $request->session()->flash('alert-error', 'Delete Websites Failed');
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
