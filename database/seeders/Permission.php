<?php

namespace Database\Seeders;

use App\Models\Permission as PermissionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'user-read', 'label' => 'Users', 'parent_id' => null, 'guard_name' => 'web'],
            ['name' => 'user-create', 'label' => 'Create', 'parent_id' => 1, 'guard_name' => 'web'],
            ['name' => 'user-update', 'label' => 'Update', 'parent_id' => 1, 'guard_name' => 'web'],
            ['name' => 'user-delete', 'label' => 'Delete', 'parent_id' => 1, 'guard_name' => 'web'],
            ['name' => 'role-read', 'label' => 'Roles', 'parent_id' => null, 'guard_name' => 'web'],
            ['name' => 'role-create', 'label' => 'Create', 'parent_id' => 5, 'guard_name' => 'web'],
            ['name' => 'role-update', 'label' => 'Update', 'parent_id' => 5, 'guard_name' => 'web'],
            ['name' => 'role-delete', 'label' => 'Delete', 'parent_id' => 5, 'guard_name' => 'web'],
            ['name' => 'permissions', 'label' => 'Permissions', 'parent_id' => null, 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            PermissionModel::create($permission);
        }
    }
}
