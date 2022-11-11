<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CoreTrait
{
    /**
     * Create random code.
     *
     * @param  string  $prefix
     * @param  string  $table
     * @return string
     */
    public function createCode(string $prefix, string $table): string
    {
        $user = Auth::id();
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('y');
        $index = DB::table($table)->max('id') + 1;

        $index = str_pad($index, 3, '0', STR_PAD_LEFT);

        return $prefix.$user.$year.$month.$index;
    }

    /**
     * Check record exist.
     *
     * @param  string  $table
     * @param  string  $name
     * @param  string  $column
     * @return object|null
     */
    public function checkDuplicate($table, $name, $column)
    {
        return DB::table($table)
            ->where($column, '=', $name)
            ->first();
    }

    /**
     * Get ID for PostgreSQL.
     *
     * @param  string  $table
     * @return int
     */
    public function getID($table)
    {
        return DB::table($table)->count() == 0 ? 1 : DB::table($table)
            ->select(['id'])
            ->orderByDesc('id')
            ->limit(1)->first()
            ->id + 1;
    }

    /**
     * Get total ram.
     *
     * @return array|object
     */
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

            return [
                'memory' => $memory,
                'total_ram' => round(number_format($totalmemInGB)),
                'used_memory_in_gb' => round(number_format($usedmemInGB)),
            ];
        } else {
            $free = shell_exec('free');
            $free = (string) trim($free);
            $free_arr = explode("\n", $free);
            $mem = explode(' ', $free_arr[1]);
            $mem = array_filter($mem);
            $mem = array_merge($mem);
            $usedmem = $mem[2];
            $usedmemInGB = number_format($usedmem / 1048576, 2);
            $memory1 = $mem[2] / $mem[1] * 100;
            $memory = round($memory1);
            $fh = fopen('/proc/meminfo', 'r');
            $mem = 0;
            while ($line = fgets($fh)) {
                $pieces = [];
                if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                    $mem = $pieces[1];
                    break;
                }
            }
            fclose($fh);
            $totalram = number_format($mem / 1048576, 2);

            return [
                'memory' => $memory, 'total_ram' => $totalram, 'used_memory_in_gb' => $usedmemInGB,
            ];
        }
    }

    /**
     * Get total CPU.
     *
     * @return array|object
     */
    public function getTotalCPU()
    {
        $os = strtolower(PHP_OS);
        $windows = '/win/i';
        if (preg_match_all($windows, $os) == 1) {
            exec('wmic cpu get LoadPercentage', $p);

            return [
                'load' => $p[1].'% / 100%', 'load_width' => $p[1].'%',
            ];
        } else {
            $cpu_loaded = sys_getloadavg();
            $load_width = $cpu_loaded[0];
            $load = $cpu_loaded[0].'% / 100%';

            return [
                'load' => $load, 'load_width' => $load_width,
            ];
        }
    }

    /**
     * Get total disk.
     *
     * @return array|object
     */
    public function getTotalDisk()
    {
        $total_disk = disk_total_space('/');
        $total_disk_size = $total_disk / 1073741824;

        $free_disk = disk_free_space('/');
        $used_disk = $total_disk - $free_disk;

        $disk_used_size = $used_disk / 1073741824;
        $use_disk = round(100 - (($disk_used_size / $total_disk_size) * 100));

        $diskuse = round(100 - ($use_disk));

        return [
            'diskuse' => $diskuse,
            'total_disk_size' => round($total_disk_size).__(' GB'),
            'disk_used_size' => round($disk_used_size).__(' GB'),
        ];
    }
}
