<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Template\MainController;
use App\Models\Template\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Sarfraznawaz2005\ServerMonitor\ServerMonitor;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MainController $MainController, ServerMonitor $serverMonitor)
    {
        $this->middleware('auth');
        $this->MainController = $MainController;
        $this->serverMonitor = $serverMonitor;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $log = Log::limit(7)
            ->orderBy('id', 'desc')
            ->get();
        $users = User::count();
        $logCount = Log::where('u_id', Auth::user()->id)
            ->count();

        return view('dashboard', [
            'log' => $log,
            'users' => $users,
            'logCount' => $logCount,
            'ram' => $this->MainController->getTotalRAM(),
            'cpu' => $this->MainController->getTotalCPU(),
            'disk' => $this->MainController->getTotalDisk(),
        ]);
    }

    public function log(Request $req)
    {
        if ($req->ajax()) {
            $data = Log::where('u_id', Auth::user()->id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('added_at', function ($row) {
                    return date("d-M-Y H:m", strtotime($row->added_at));
                })
                ->rawColumns(['added_at'])
                ->make(true);
        }
        return view('pages.backend.log.IndexLog');
    }

    public function serverMonitor(Request $req)
    {
        $checkResults = $this->serverMonitor->getChecks();
        $lastRun = $this->serverMonitor->getLastCheckedTime();

        return view('pages.backend.server.indexServer', compact(
            'checkResults',
            'lastRun'
        ));
    }
}