<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Models\Core\ActivityList;
use App\Models\Core\ActivityType;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the activity all dashboard.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return mixed
     */
    public function activity(Request $req)
    {
        if ($req->ajax()) {
            $data = Activity::all();

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
                ->addColumn('user', function ($row) {
                    return $row->causer->name;
                })
                ->rawColumns(['added_at', 'ip', 'user_agent', 'user'])
                ->make(true);
        }

        return view('pages.backend.log.IndexActivity');
    }

    /**
     * Show the activity list dashboard.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return mixed
     */
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
            'type' => $type,
        ]);
    }

    /**
     * Store a new list.
     *
     * @param  \App\Http\Requests\ActivityRequest  $req
     * @return \Illuminate\Http\Response
     */
    public function listStore(ActivityRequest $req)
    {
        $performedOn = ActivityList::create([
            'name' => $req->name_activity,
            'type_id' => $req->type,
        ]);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(10),
            true,
            ActivityList::find($performedOn->id)
        );
    }

    /**
     * Show the activity type dashboard.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return mixed
     */
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

    /**
     * Store a new list type.
     *
     * @param  \App\Http\Requests\ActivityRequest  $req
     * @return \Illuminate\Http\Response
     */
    public function typeStore(ActivityRequest $req)
    {
        $performedOn = ActivityType::create([
            'name' => $req->name_type,
        ]);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(11),
            true,
            ActivityType::find($performedOn->id)
        );
    }
}
