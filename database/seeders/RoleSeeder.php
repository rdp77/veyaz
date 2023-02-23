<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $roles = [
    		['name' => 'admin'],
            ['name' => 'user'],		
	    ];

	    foreach(array_chunk($roles, 100) as $t) {
		    DB::table('roles')->insert($t);
	    };
    }
}
