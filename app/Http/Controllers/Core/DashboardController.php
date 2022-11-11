<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MainController $MainController)
    {
        $this->middleware('auth');
        $this->MainController = $MainController;
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View|object
     */
    public function index()
    {
        $log = Activity::limit(7)
            ->orderBy('id', 'desc')
            ->get();
        $users = User::count();
        $logCount = Activity::where('causer_id', Auth::user()->id)
            ->count();

        return view('dashboard', [
            'log' => $log,
            'users' => $users,
            'logCount' => $logCount,
        ]);
    }

    /**
     * Show the log dashboard.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\View\View
     */
    public function log(Request $req)
    {
        if ($req->ajax()) {
            $data = Activity::where('causer_id', Auth::user()->id)
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('added_at', function ($row) {
                    return date('d-M-Y H:m', strtotime($row->created_at));
                })
                ->addColumn('url', function ($row) {
                    return $row->getExtraProperty('url');
                })
                ->addColumn('ip', function ($row) {
                    return $row->getExtraProperty('ip');
                })
                ->addColumn('user_agent', function ($row) {
                    return $row->getExtraProperty('user_agent');
                })
                ->rawColumns(['added_at', 'ip', 'user_agent'])
                ->make(true);
        }

        return view('pages.backend.log.IndexLog');
    }

    /**
     * Show the document page.
     *
     * @param  Request  $req
     * @return \Illuminate\View\View|object
     */
    public function doc()
    {
    }

    /**
     * Show the settings page.
     *
     * @param  Request  $req
     * @return \Illuminate\View\View|object
     */
    public function settings(Request $req)
    {
        return view('pages.backend.core.settings');
    }
}
