<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('dashboard', [
            'log' => Log::limit(7)
                ->get()
        ]);
    }

    public function log()
    {
        return view('pages.backend.log.IndexLog', [
            'log' => Log::all()
        ]);
    }
}
