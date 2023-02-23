<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions', ['only' => ['index']]);
    }

    public function index() {
        $permissions = Permission::whereNull('parent_id')->get(['id', 'name', 'label']);
        foreach ($permissions as $permission) {
            $create = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-create')
                ->count();

            $update = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-update')
                ->count();


            $delete = $feature['delete'] = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-delete')
                ->count();

            $permission['create'] = boolval($create);
            $permission['update'] = boolval($update);
            $permission['delete'] = boolval($delete);
        }

        return view('pages.auth.permissions.index', compact('permissions'));
    }
}
