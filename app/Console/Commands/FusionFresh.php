<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FusionFresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fusion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database imported function';

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
        if ($this->confirm('Cleaning Database And Restore Datas?')) {
            Artisan::call("migrate:fresh --seed");
            $this->info('Importing Database Successful!');
        } else {
            Artisan::call("migrate:fresh");
            $this->newLine();
            $this->info('Cleaning Database Successful!');

            // $count = 9;
            // $this->output->progressStart($count);

            // for ($i = 0; $i < $count; $i++) {
            //     sleep(1);
            //     switch ($i) {
            //         case 0:
            //             Artisan::call("migrate:fresh");
            //             $this->newLine();
            //             $this->info('Cleaning Database Successful!');
            //             break;
            //         case 1:
            //             Artisan::call("laravolt:indonesia:seed");
            //             break;
            //         case 2:
            //             Artisan::call("db:seed --class=User");
            //             break;
            //         case 3:
            //             Artisan::call("db:seed --class=MemberSeeder");
            //             break;
            //         case 4:
            //             Artisan::call("db:seed --class=RatesSeeder");
            //             break;
            //         case 5:
            //             Artisan::call("db:seed --class=MenuSeeder");
            //             break;
            //         case 6:
            //             Artisan::call("db:seed --class=SubMenuSeeder");
            //             break;
            //         case 7:
            //             Artisan::call("db:seed --class=PrivilegeSeeder");
            //             Artisan::call("db:seed --class=InstallmentSeeder");
            //             Artisan::call("db:seed --class=CashDataSeeder");
            //             break;
            //         case 8:
            //             Artisan::call("db:seed --class=AccountTypeSeeder");
            //             $this->newLine();
            //             $this->info('Importing Database Successful!');
            //             break;
            //     }
            //     $this->output->progressAdvance();
            // }

            // $this->output->progressFinish();
        }
    }
}