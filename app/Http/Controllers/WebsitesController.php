<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWebsitesRequest;
use App\Http\Requests\UpdateWebsitesRequest;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Facades\Auth;

class WebsitesController extends Controller
{
    protected $websiteRepository;
    /**
     * WebsitesController constructor.
     * @param WebsiteRepository $websiteRepository
     */
    public function __construct(WebsiteRepository $websiteRepository)
    {
        $this->middleware('auth');

        $this->websiteRepository = $websiteRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $listWebsite = $this->websiteRepository->all();

        $listFrequency = Website::LIST_FREQUENCY;

        $listSensitivity = Website::LIST_SENSITIVITY;

        $listStatus = Website::LIST_STATUS;

        return view('websites.index', compact('listWebsite', 'listFrequency', 'listSensitivity', 'listStatus'));
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

        return view('websites.add', compact('listFrequency', 'listSensitivity', 'listStatus'));
    }

    /**
     * view update website
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        $website = $this->websiteRepository->find($id);

        if(empty($website)) abort(404);

        $listFrequency = Website::LIST_FREQUENCY;

        $listSensitivity = Website::LIST_SENSITIVITY;

        $listStatus = Website::LIST_STATUS;

        return view('websites.update', compact('website', 'listFrequency', 'listSensitivity', 'listStatus'));
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
            //messgae alert success
            $request->session()->flash('alert-success', 'Update Success');

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
}
