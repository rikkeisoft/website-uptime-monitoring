<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use App\Contracts\Constants;
use App\Http\Requests\AddWebsitesRequest;
use App\Http\Requests\UpdateWebsitesRequest;
use App\Models\Website;
use App\Repositories\AlertGroupsRepository;
use App\Repositories\MonitorRepository;
use App\Repositories\WebsiteRepository;

class WebsitesController extends Controller
{
    protected $websiteRepository;
    protected $monitorRepository;
    protected $alertGroupsRepository;

    /**
     * WebsitesController constructor.
     *
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
     * view list website.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listWebsite = $this->websiteRepository->paginate(Constants::DEFAULT_PER_PAGE);
        $listAlertGroup = $this->alertGroupsRepository->all();

        return view('websites.index')
            ->with([
                'listWebsites' => $listWebsite,
                'listFrequencys' => Website::LIST_FREQUENCYS,
                'listResults' => Website::LIST_RESULTS,
                'listSensitivitys' => Website::LIST_SENSITIVITYS,
                'listStatus' => Website::LIST_STATUS,
                'listAlertGroup' => $listAlertGroup,
            ]);
    }

    /**
     * Display Website Creating Form
     *
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
                'listAlertGroup' => $listAlertGroup,
            ]);
    }

    public function show()
    {
    }

    /**
     * view update website.
     *
     * @param string $id
     *
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
                'listAlertGroup' => $listAlertGroup,
            ]);
    }

    public function statistics(string $websiteId)
    {
        $stats = [
            'duration' => [],
            'time' => [],
            'up' => 0,
            'down' => 0
        ];
        $website = $this->websiteRepository->find($websiteId);
        $title = "{$website->name} <{$website->url}>";

        try {
            $redis = Redis::connection();
            $key = "statistics_{$websiteId}";
            $listLength = $redis->llen($key);

            // Get requests log of website
            $logs = $redis->lrange($key, $listLength - Constants::NUMBER_OF_MILESTONES, $listLength);
            if (!empty($logs)) {
                foreach ($logs as $log) {
                    $log = json_decode($log);
                    $stats['duration'][] = $log->time_request;
                    $stats['time'][] = $log->created_at;
                    if ($log->success == Constants::STATUS_FAILED) {
                        $stats['down'] += 1;
                    } else {
                        $stats['up'] += 1;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
        }

        return view('websites.statistics')
            ->with([
                'stats' => $stats,
                'time' => implode('|', $stats['time']),
                'title' => $title,
            ]);
    }

    /**
     * add new website post.
     *
     * @param AddWebsitesRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddWebsitesRequest $request)
    {
        $data = $request->only('url', 'name', 'sensitivity', 'status', 'frequency');
        $data['user_id'] = Auth::user()->id;
        $createWebsite = $this->websiteRepository->create($data);

        if ($createWebsite) {
            // Create monitor with website
            $dataMonitor = $request->only('alert_group_id');
            $dataMonitor['website_id'] = $createWebsite->id;
            $dataMonitor['result'] = Constants::STATUS_PENDING;
            $createMonitor = $this->monitorRepository->create($dataMonitor);

            if ($createMonitor) {
                $request->session()->flash('alert-success', 'Add Websites Successfully');
            } else {
                $request->session()->flash('alert-error', 'Add Monitor Websites Failed');
            }

            return redirect()->route('websites.index');
        }
        $request->session()->flash('alert-error', 'Add Websites Failed');

        return redirect()->back();
    }

    /**
     * update website post.
     *
     * @param UpdateWebsitesRequest $request
     * @param string                $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateWebsitesRequest $request, string $id)
    {
        $data = $request->only('url', 'name', 'sensitivity', 'status', 'frequency');
        $update = $this->websiteRepository->update($data, $id);

        if ($update) {
            // Update monitor with website
            $dataMonitor = $request->only('alert_group_id');
            $monitorId = $update->monitor->first()->id;
            $updateMonitor = $this->monitorRepository->update($dataMonitor, $monitorId);

            if ($updateMonitor) {
                $request->session()->flash('alert-success', 'Update Websites Successfully');
            } else {
                $request->session()->flash('alert-error', 'Update Monitor Websites Failed');
            }

            return redirect()->route('websites.index');
        }
        $request->session()->flash('alert-error', 'Update Websites Failed');

        return redirect()->back();
    }

    /**
     * Delete a website
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        $selectedIds = explode(',', $selectedIds);

        if (empty($selectedIds)) {
            $request->session()->flash('alert-error', 'Delete Websites Failed');

            return redirect()->back();
        }
        $isDeleted = $this->websiteRepository->delete($selectedIds);

        if ($isDeleted) {
            $request->session()->flash('alert-success', 'Delete Websites Successfully');

            return redirect()->route('websites.index');
        }
        $request->session()->flash('alert-error', 'Delete Websites Failed');

        return redirect()->back();
    }

    /**
     * Toggle status of a website
     *
     * @param Request $request
     *
     * @return json
     */
    public function setEnableDisable(Request $request)
    {
        $status = $request->input('status');
        $status == Website::STATUS_ENABLED ? $check = Website::STATUS_DISABLED : $check = Website::STATUS_ENABLED;
        $data = [
            'status' => $check,
        ];

        $id = $request->input('id');
        $update = $this->websiteRepository->update($data, $id);

        if (isset($update->id)) {
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }
}
