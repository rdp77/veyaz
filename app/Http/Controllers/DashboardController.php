<?php

namespace App\Http\Controllers;

use App\Models\Template\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('createLog');
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
            'logCount' => $logCount
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
}