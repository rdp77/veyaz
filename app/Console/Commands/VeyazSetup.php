<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class VeyazSetup extends Command
{
    /**
     * Header for the console.
     *
     * @var string
     */
    private static string $template = '
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
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
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

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function env(): void
    {
        // Copy .env file
        if (!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
            $this->info('Environment File Created Successful.');
        }
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function connection(): void
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

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function checkConnection(): void
    {
        $this->info('Checking Database Connection');
        try {
            DB::connection()->getPdo();
            $this->info('Database Connection Successful to ' . DB::connection()->getDatabaseName());
        } catch (\Exception $e) {
            $this->error('Database Connection Failed.');
        }
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function key(): void
    {
        Artisan::call('key:generate');
        $this->info('Application Key Set Successfully.');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function clear(): void
    {
        Artisan::call('optimize:clear');
        $this->info('Cache Cleared Successfully.');
    }

    /**
     * Execute the console command.
     *
     * @return bool true if the command fails, false otherwise
     */
    public function checkDatabaseExists(): bool
    {
        $databaseName = env('DB_DATABASE');
        $databaseExists = DB::select(
            "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA
                   WHERE SCHEMA_NAME = '$databaseName'");
        if (!empty($databaseExists)) {
            $this->info('Database already exists.');

            return true;
        }
        $this->createDatabase();

        return false;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function createDatabase(): void
    {
        $databaseName = env('DB_DATABASE');
        DB::statement("CREATE DATABASE $databaseName");
        $this->info('Database created successfully.');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function migrate(): void
    {
        Artisan::call('migrate:refresh --seed');
        $this->info('Importing Database Successful.');
    }
}
