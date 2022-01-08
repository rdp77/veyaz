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
        $user = Auth::user()->id;
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

    public function createLog($header, $ip, $action)
    {
        Log::create([
            'info' => $action,
            'u_id' => Auth::user()->id,
            'url' => URL::full(),
            'user_agent' => $header,
            'ip' => $ip,
            'added_at' => date("Y-m-d H:i:s"),
        ]);
    }

    public function getTotalRAM()
    {
        $os = strtolower(PHP_OS);
        $windows = '/win/i';
        if (preg_match_all($windows, $os) == 1) {
            exec('wmic ComputerSystem get TotalPhysicalMemory', $totalMemory);
            exec('wmic OS get FreePhysicalMemory', $freeMemory);
            $getTotal = array_sum($totalMemory);
            $getfree = array_sum($freeMemory);
            $totalmemInGB = $getTotal / 1048576;
            $freememInGB = $getfree / 1048576;
            $usedmemInGB = $totalmemInGB - $freememInGB;
            $memory = number_format(100 - ($getfree * 100 / $getTotal), 2);

            return array(
                "memory" => $memory,
                "total_ram" => round(number_format($totalmemInGB)),
                "used_memory_in_gb" => round(number_format($usedmemInGB))
            );
        } else {
            $free = shell_exec('free');
            $free = (string) trim($free);
            $free_arr = explode("\n", $free);
            $mem = explode(" ", $free_arr[1]);
            $mem = array_filter($mem);
            $mem = array_merge($mem);
            $usedmem = $mem[2];
            $usedmemInGB = number_format($usedmem / 1048576, 2);
            $memory1 = $mem[2] / $mem[1] * 100;
            $memory = round($memory1);
            $fh = fopen('/proc/meminfo', 'r');
            $mem = 0;
            while ($line = fgets($fh)) {
                $pieces = array();
                if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                    $mem = $pieces[1];
                    break;
                }
            }
            fclose($fh);
            $totalram = number_format($mem / 1048576, 2);

            return array(
                "memory" => $memory, "total_ram" => $totalram, "used_memory_in_gb" => $usedmemInGB
            );
        }
    }

    public function getTotalCPU()
    {
        $os = strtolower(PHP_OS);
        $windows = '/win/i';
        if (preg_match_all($windows, $os) == 1) {
            exec('wmic cpu get LoadPercentage', $p);
            return array(
                "load" => $p[1] . '% / 100%', "load_width" => $p[1] . '%'
            );
        } else {
            $cpu_loaded = sys_getloadavg();
            $load_width = $cpu_loaded[0];
            $load = $cpu_loaded[0] . '% / 100%';

            return array(
                "load" => $load, "load_width" => $load_width
            );
        }
    }

    public function getTotalDisk()
    {
        $total_disk = disk_total_space('/');
        $total_disk_size = $total_disk / 1073741824;

        $free_disk = disk_free_space('/');
        $used_disk = $total_disk - $free_disk;

        $disk_used_size = $used_disk / 1073741824;
        $use_disk = round(100 - (($disk_used_size / $total_disk_size) * 100));

        $diskuse = round(100 - ($use_disk));

        return array(
            "diskuse" => $diskuse,
            "total_disk_size" => round($total_disk_size) . __(' GB'),
            "disk_used_size" => round($disk_used_size) . __(' GB')
        );
    }

    public function serverMonitorRefreshAll(): array
    {
        return $this->serverMonitor->runChecks();
    }

    public function serverMonitorRefresh(): array
    {
        return $this->serverMonitor->runCheck(request()->check);
    }
}