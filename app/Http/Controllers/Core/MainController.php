<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Models\Core\City;
use App\Models\Core\District;
use App\Models\Core\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MainController extends Controller
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
     * Get city list by province.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function getCity(Request $req)
    {
        $data['city'] = City::where('province_id', $req->province_id)
            ->get(['name', 'id']);

        return Response::json($data);
    }

    /**
     * Get district list by city.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function getDistrict(Request $req)
    {
        $data['district'] = District::where('city_id', $req->city_id)
            ->get(['name', 'id']);

        return Response::json($data);
    }

    /**
     * Get village list by district.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function getVillage(Request $req)
    {
        $data['village'] = Village::where('district_id', $req->district_id)
            ->get(['name', 'id']);

        return Response::json($data);
    }
}
