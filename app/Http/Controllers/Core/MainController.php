<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Template\City;
use App\Models\Template\District;
use App\Models\Template\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Sarfraznawaz2005\ServerMonitor\ServerMonitor;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServerMonitor $serverMonitor)
    {
        $this->middleware('auth');
        $this->serverMonitor = $serverMonitor;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function changeMonthIdToEn($dates)
    {
        $dateLocale = $dates;

        $separateString = explode(' ', $dateLocale);

        $day    = $separateString[0];
        $month  = $separateString[1];
        $year   = $separateString[2];

        if ($month == 'Januari') {
            $month = '01';
        } elseif ($month == 'Februari') {
            $month = '02';
        } elseif ($month == 'Maret') {
            $month = '03';
        } elseif ($month == 'April') {
            $month = '04';
        } elseif ($month == 'Mei') {
            $month = '05';
        } elseif ($month == 'Juni') {
            $month = '06';
        } elseif ($month == 'Juli') {
            $month = '07';
        } elseif ($month == 'Agustus') {
            $month = '08';
        } elseif ($month == 'September') {
            $month = '09';
        } elseif ($month == 'Oktober') {
            $month = '10';
        } elseif ($month == 'November') {
            $month = '11';
        } elseif ($month == 'Desember') {
            $month = '12';
        }

        return $year . '-' . $month . '-' . $day;
    }

    public function getDate($date)
    {
        $dateLocale = $date;

        $separateString = explode(' ', $dateLocale);
        $day    = $separateString[0];
        $monthLocale  = $separateString[1];
        $year   = $separateString[2];
        $month   = $this->changeMonthIdToEn($monthLocale);

        return $year . '-' . $month . '-' . $day;
    }

    public function createCode($prefix, $table)
    {
        $user = Auth::check() ? Auth::id() : 00;
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('y');
        $index = DB::table($table)->max('id') + 1;

        $index = str_pad($index, 3, '0', STR_PAD_LEFT);

        return $prefix . $user . $year . $month . $index;
    }

    public function checkDuplicate($table, $name, $column)
    {
        return DB::table($table)
            ->where($column, '=', $name)
            ->first();
    }

    public function validator($validator)
    {
        $data = array();
        foreach ($validator as $message) {
            array_push($data, $message);
        }
        return $data;
    }

    //TODO For PostgreSQL
    public function getID($table)
    {
        return DB::table($table)->count() == 0 ? 1 : DB::table($table)
            ->select(['id'])
            ->orderByDesc('id')
            ->limit(1)->first()
            ->id + 1;
    }

    public function getCity(Request $req)
    {
        $data['city'] = City::where("province_id", $req->province_id)
            ->get(["name", "id"]);

        return Response::json($data);
    }

    public function getDistrict(Request $req)
    {
        $data['district'] = District::where("city_id", $req->city_id)
            ->get(["name", "id"]);

        return Response::json($data);
    }

    public function getVillage(Request $req)
    {
        $data['village'] = Village::where("district_id", $req->district_id)
            ->get(["name", "id"]);

        return Response::json($data);
    }

    public function serverMonitorRefreshAll(): array
    {
        return $this->serverMonitor->runChecks();
    }

    public function createLog($header, $ip, $action, $withPerformedOn = false, $performedOn = null)
    {
        if ($withPerformedOn) {
            activity()
                ->causedBy(Auth::user()->id)
                ->performedOn($performedOn)
                ->withProperties([
                    'url' => URL::full(),
                    'ip' => $ip,
                    'user_agent' => $header
                ])
                ->log($action);
        } else {
            activity()
                ->causedBy(Auth::user()->id)
                ->withProperties([
                    'url' => URL::full(),
                    'ip' => $ip,
                    'user_agent' => $header
                ])
                ->log($action);
        }
    }

    public function serverMonitorRefresh(): array
    {
        return $this->serverMonitor->runCheck(request()->check);
    }
}