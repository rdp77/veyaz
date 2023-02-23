<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User as UserModel;
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
        $user = UserModel::create([
            'name' => 'Anonymous Admin',
            'username' => 'admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin')
        ]);

        $role = Role::create(['name' => 'Admin']);
        
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        Role::create(['name' => 'User']);
    }
}
