<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class VeyazCon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'veyaz:con';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connection Database function';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->connection();
    }

    function connection()
    {
        // Choice Database Connection
        $databaseConnection = [
            1 => 'SQLite',
            2 => 'MySQL',
            3 => 'PostgreSQL',
            4 => 'SQL Server',
        ];

        $choice = array_search(
            $this->choice('Select Database Connection', $databaseConnection),
            $databaseConnection
        );

        $hostname = $this->ask('Database Hostname?');
        $port = $this->ask('Database Port?');
        $database = $this->ask('Database Name?');
        $username = $this->ask('Database Username?');
        $password = $this->ask('Database Password?');

        switch ($choice) {
            case 1:
                Artisan::call("env:set DB_CONNECTION sqlite");
                Artisan::call("env:set DB_HOST $hostname");
                Artisan::call("env:set DB_PORT $port");
                Artisan::call("env:set DB_DATABASE $database");
                Artisan::call("env:set DB_USERNAME $username");
                Artisan::call("env:set DB_PASSWORD $password");
                break;
            case 2:
                Artisan::call("env:set DB_CONNECTION mysql");
                Artisan::call("env:set DB_HOST $hostname");
                Artisan::call("env:set DB_PORT $port");
                Artisan::call("env:set DB_DATABASE $database");
                Artisan::call("env:set DB_USERNAME $username");
                Artisan::call("env:set DB_PASSWORD $password");
                break;
            case 3:
                Artisan::call("env:set DB_CONNECTION pgsql");
                Artisan::call("env:set DB_HOST $hostname");
                Artisan::call("env:set DB_PORT $port");
                Artisan::call("env:set DB_DATABASE $database");
                Artisan::call("env:set DB_USERNAME $username");
                Artisan::call("env:set DB_PASSWORD $password");
                break;
            case 4:
                Artisan::call("env:set DB_CONNECTION sqlsrv");
                Artisan::call("env:set DB_HOST $hostname");
                Artisan::call("env:set DB_PORT $port");
                Artisan::call("env:set DB_DATABASE $database");
                Artisan::call("env:set DB_USERNAME $username");
                Artisan::call("env:set DB_PASSWORD $password");
                break;
            default:
                Artisan::call("env:set DB_CONNECTION mysql");
                Artisan::call("env:set DB_HOST $hostname");
                Artisan::call("env:set DB_PORT $port");
                Artisan::call("env:set DB_DATABASE $database");
                Artisan::call("env:set DB_USERNAME $username");
                Artisan::call("env:set DB_PASSWORD $password");
                break;
        }
        $this->info('Set Database Connection Successful.');
    }
}