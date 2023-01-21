<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Scope extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scopes')->insert([
            [
                'role' => 'Admin',
                'description' => 'Admin',
            ],  
            [
                'role' => 'Guest',
                'description' => 'Guest',
            ],
        ]);
    }
}
