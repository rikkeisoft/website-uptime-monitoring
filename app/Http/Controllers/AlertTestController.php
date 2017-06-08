<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlertGroup;
use Yajra\Datatables\Datatables;

class AlertTestController extends Controller
{
    /**
     * Display index page.
     *
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('eloquent.array');
    }

    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Datatables $datatables)
    {
        return $datatables->eloquent(AlertGroup::select('name', 'created_at', 'updated_at'))
                          ->addColumn('action', 'eloquent.tables.alert_groups-action')
                          ->rawColumns([5])
                          ->make();
    }
}
