<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-read|role-create|role-edit|role-delete', ['only' => ['index', 'recycle']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-update', ['only' => ['edit', 'update', 'restore', 'restoreAll']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy', 'delete', 'deleteAll']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Role::orderBy('name');
            if (request()->route()->getName() == "roles.recycle") {
                $query->onlyTrashed();
            }

            $roles = $query->get();
            return response()->json(ResponseResource::collection($roles));
        }

        $role_count = Role::count();
        $role_trash_count = Role::onlyTrashed()->count();
        return view('pages.auth.roles.index', compact('role_count', 'role_trash_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::whereNull('parent_id')->get(['id', 'name', 'label']);
        foreach ($permissions as $permission) {
            $create = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-create')
                ->first();

            $update = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-update')
                ->first();


            $delete = $feature['delete'] = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-delete')
                ->first();

            $permission['create'] = $create;
            $permission['update'] = $update;
            $permission['delete'] = $delete;
        }
        return view('pages.auth.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($request->permission);

        $role->encrypt_id = encrypt($role->id);

        return response()->json([
            "status" => "success",
            "data" => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = Permission::whereNull('parent_id')->get(['id', 'name', 'label']);
        foreach ($permissions as $permission) {
            $create = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-create')
                ->first();

            $update = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-update')
                ->first();


            $delete = $feature['delete'] = Permission::where('parent_id', $permission->id)
                ->where('name', 'like', '%-delete')
                ->first();

            $permission['create'] = $create;
            $permission['update'] = $update;
            $permission['delete'] = $delete;
        }

        $role = Role::find(decrypt($id));
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", decrypt($id))
            ->pluck('role_has_permissions.permission_id')
            ->all();
        return view('pages.auth.roles.edit', compact('permissions', 'role', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . decrypt($id),
            'permission' => 'required'
        ]);

        $role = Role::find(decrypt($id));
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permission);

        return response()->json([
            "status" => "success",
            "data" => $role
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json([
            "status" => "success",
            "data" => null
        ]);
    }

    /** SoftDelete ================ */

    /**
     * Restore data from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Role::onlyTrashed()->where('id', $id)->restore();
        return response()->json([
            "status" => "success",
            "data" => null
        ]);
    }

    /**
     * Restore All data from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreAll()
    {
        Role::onlyTrashed()->restore();
        return response()->json([
            "status" => "success",
            "data" => null
        ]);
    }


    /**
     * Remove pemanent in trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Role::onlyTrashed()->where('id', $id)->forceDelete();
        return response()->json([
            "status" => "success",
            "data" => null
        ]);
    }

    /**
     * Remove all pemanent in trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAll()
    {
        Role::onlyTrashed()->forceDelete();
        return response()->json([
            "status" => "success",
            "data" => null
        ]);
    }
    
}
