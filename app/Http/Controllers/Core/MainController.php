<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Template\City;
use App\Models\Template\District;
use App\Models\Template\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
     * Get city list by province.
     *
     * @param  \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function getCity(Request $req)
    {
        $data['city'] = City::where("province_id", $req->province_id)
            ->get(["name", "id"]);

        return Response::json($data);
    }

    /**
     * Get district list by city.
     *
     * @param  \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function getDistrict(Request $req)
    {
        $data['district'] = District::where("city_id", $req->city_id)
            ->get(["name", "id"]);

        return Response::json($data);
    }

    /**
     * Get village list by district.
     *
     * @param  \Illuminate\Http\Request $req
     * @return \Illuminate\Http\Response
     */
    public function getVillage(Request $req)
    {
        $data['village'] = Village::where("district_id", $req->district_id)
            ->get(["name", "id"]);

        return Response::json($data);
    }

    /**
     * refresh all service monitor.
     *
     * @return array
     */
    public function serverMonitorRefreshAll(): array
    {
        return $this->serverMonitor->runChecks();
    }

    /**
     * refresh specified service monitor.
     *
     * @return array
     */
    public function serverMonitorRefresh(): array
    {
        return $this->serverMonitor->runCheck(request()->check);
    }
}
