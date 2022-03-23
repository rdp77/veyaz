<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use App\Models\Template\City;
use App\Models\Template\District;
use App\Models\Template\Log;
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

    public function serverMonitorRefreshAll(): array
    {
        return $this->serverMonitor->runChecks();
    }

    public function serverMonitorRefresh(): array
    {
        return $this->serverMonitor->runCheck(request()->check);
    }
}