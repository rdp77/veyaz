<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class RoleService
{
    /**
     * The model that represents with the service.
     *
     * @var App\Models\Role
     */
    protected Role $role;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Create a new role.
     *
     * @param  array  $roleData
     * @return App\Models\Role
     */
    public function createRole(array $roleData): Role
    {
        return $this->role->create([
            'role_name' => $roleData['role_name'],
        ]);
    }

    /**
     * Update a role.
     *
     * @param  int  $roleId
     * @param  array  $roleData
     * @return App\Models\Role
     */
    public function updateRole(int $roleId, array $roleData): Role
    {
        $role = $this->role->findOrFail($roleId);

        $role->update([
            'role_name' => $roleData['role_name'],
        ]);

        return $role;
    }

    /**
     * delete a role.
     *
     * @param  int  $roleId
     * @return bool
     */
    public function deleteRole(int $roleId): bool
    {
        $role = $this->role->findOrFail($roleId);

        return $role->delete();
    }

    /**
     * restore a role.
     *
     * @param  int  $roleId
     * @return bool
     */
    public function restoreRole(int $roleId): bool
    {
        $role = $this->role->onlyTrashed()->findOrFail($roleId);

        return $role->restore();
    }

    /**
     * restore all roles.
     *
     * @param  int  $roleId
     * @return bool
     */
    public function restoreAll(): bool
    {
        $role = $this->role->onlyTrashed();

        return $role->restore();
    }

    /**
     * Delete a role permanently.
     *
     * @param  int  $roleId
     * @return bool
     */
    public function deleteRoleRecycle(int $roleId): bool
    {
        $role = $this->role->onlyTrashed()->findOrFail($roleId);

        return $role->forceDelete();
    }

    /**
     * Delete all roles permanently.
     *
     * @param  int  $roleId
     * @return bool
     */
    public function deleteAllRoleRecycle(): bool
    {
        $role = $this->role->onlyTrashed();

        return $this->role->trashed() ? $role->forceDelete() :
            Response::json([
                'status' => 'error',
                'data' => 'Tidak ada data di recycle bin',
            ]);
    }

    
}
