<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Anonymous Admin',
                'username' => 'admin',
                'email' => 'admin@localhost',
                'password' => Hash::make('admin'),
                'scope_id' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ], 
            [
                'name' => 'Guest',
                'username' => 'guest',
                'email' => 'guest@localhost',
                'password' => Hash::make('guest'),
                'scope_id' => 2,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
        ]);
    }
}
