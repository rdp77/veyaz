<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class VeyazSetup extends Command
{
    private static $template = '
<fg=blue>

██╗   ██╗███████╗██╗   ██╗ █████╗ ███████╗
██║   ██║██╔════╝╚██╗ ██╔╝██╔══██╗╚══███╔╝
██║   ██║█████╗   ╚████╔╝ ███████║  ███╔╝ 
╚██╗ ██╔╝██╔══╝    ╚██╔╝  ██╔══██║ ███╔╝  
 ╚████╔╝ ███████╗   ██║   ██║  ██║███████╗
  ╚═══╝  ╚══════╝   ╚═╝   ╚═╝  ╚═╝╚══════╝
                                                                                                                               
</>
Congratulations! You successfully set up your <fg=green>Veyaz</> template!
<fg=cyan>Documentation</>: (Coming Soon)
<fg=cyan>Contribute</>: https://github.com/rdp77
<fg=cyan>Give a star</>: https://github.com/rdp77/veyaz
Made with <fg=green>love</> by the community. Be a part of it!
';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'veyaz:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup template function';

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
        $this->env();
        $this->connection();
        $this->checkConnection();
        $this->key();
        $this->clear();
        $this->checkDatabaseExists();
        $this->migrate();
        $this->line(self::$template);
    }

    function key()
    {
        Artisan::call("key:generate");
        $this->info('Application Key Set Successfully.');
    }

    function migrate()
    {
        Artisan::call("migrate:refresh --seed");
        $this->info('Importing Database Successful.');
    }

    function clear()
    {
        Artisan::call("optimize:clear");
        $this->info('Cache Cleared Successfully.');
    }

    function env()
    {
        // Copy .env file
        if (!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
            $this->info('Environment File Created Successful.');
        }
    }

    function connection()
    {
        $this->info('Database Setup');
        foreach (['DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME'] as $key) {
            $config[$key] = $this->ask('- ' . $key . ' (' . env($key) . ')');
            Artisan::call("env:set $key $config[$key]");
        }
        $config['DB_PASSWORD'] = $this->secret('- DB_PASSWORD (' . env($key) . ')');
        Artisan::call("env:set DB_PASSWORD $config[DB_PASSWORD]");
        $this->info('Set Database Connection Successful.');
    }

    function checkConnection()
    {
        $this->info('Checking Database Connection');
        try {
            DB::connection()->getPdo();
            $this->info('Database Connection Successful to ' . DB::connection()->getDatabaseName());
        } catch (\Exception $e) {
            $this->error('Database Connection Failed.');
        }
    }

    function createDatabase()
    {
        $databaseName = env('DB_DATABASE');
        DB::statement("CREATE DATABASE $databaseName");
        $this->info('Database created successfully.');
    }

    function checkDatabaseExists()
    {
        $databaseName = env('DB_DATABASE');
        $databaseExists = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'");
        if (!empty($databaseExists)) {
            $this->info('Database already exists.');
            return true;
        }
        $this->createDatabase();
        return false;
    }
}