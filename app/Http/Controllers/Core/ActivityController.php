<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\MainController;
use App\Http\Requests\ActivityRequest;
use App\Models\Template\ActivityList;
use App\Models\Template\ActivityType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function activity(Request $req)
    {
        if ($req->ajax()) {
            $data = Activity::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('added_at', function ($row) {
                    return date("d-M-Y H:m", strtotime($row->created_at));
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
                ->addColumn('user', function ($row) {
                    return $row->causer->name;
                })
                ->rawColumns(['added_at', 'ip', 'user_agent', 'user'])
                ->make(true);
        }
        return view('pages.backend.log.IndexActivity');
    }

    public function list(Request $req)
    {
        $type = ActivityType::all();
        if ($req->ajax()) {
            $data = ActivityList::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    return $row->activityType->name;
                })
                ->rawColumns(['type'])
                ->make(true);
        }
        return view('pages.backend.log.IndexActivityList', [
            'type' => $type
        ]);
    }

    public function listStore(ActivityRequest $req)
    {
        ActivityList::create([
            'name' => $req->name_activity,
            'type_id' => $req->type
        ]);
    }

    public function type(Request $req)
    {
        if ($req->ajax()) {
            $data = ActivityType::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.backend.log.IndexActivityType');
    }

    public function typeStore(ActivityRequest $req)
    {
        ActivityType::create([
            'name' => $req->name_type
        ]);
    }
}