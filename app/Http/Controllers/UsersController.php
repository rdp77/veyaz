<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResponseResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-read|user-create|user-edit|user-delete', ['only' => ['index', 'recycle']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-update', ['only' => ['edit', 'update', 'restore', 'restoreAll']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy', 'delete', 'deleteAll']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::with('roles')->orderBy('name');
            if (request()->route()->getName() == "users.recycle") {
                $query->onlyTrashed();
            }

            $users = $query->get();
            return response()->json(ResponseResource::collection($users));
        }

        $user_count = User::count();
        $user_trash_count = User::onlyTrashed()->count();
        return view('pages.auth.users.index', compact('user_count', 'user_trash_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('pages.auth.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->assignRole($request->input('roles'));

        return response()->json([
            "status" => "success",
            "data" => $user
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
        $user = User::find(decrypt($id));
        $roles = Role::orderBy('name', 'ASC')->get();
        $userRole = $user->roles->pluck('name')->all();
        return view('pages.auth.users.edit', compact("user", "roles", "userRole"));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . decrypt($id),
            'password' => 'confirmed',
            'roles' => 'required',
        ]);

        $data = $request->all();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, array('password'));
        }

        $data['role'] = implode(",", $request->roles);

        $user = User::find(decrypt($id));
        $user->update($data);

        DB::table('model_has_roles')->where('model_id', decrypt($id))->delete();
        $user->assignRole($request->input('roles'));

        return response()->json([
            "status" => "success",
            "data" => $user
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
        $user = User::find($id);
        $user->delete();

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
        User::onlyTrashed()->where('id', $id)->restore();
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
        User::onlyTrashed()->restore();
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
        User::onlyTrashed()->where('id', $id)->forceDelete();
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
        User::onlyTrashed()->forceDelete();
        return response()->json([
            "status" => "success",
            "data" => null
        ]);
    }

    /**
     * Resetting password the given user.
     *
     * @param string $id
     * @param Request $req
     * @return \Illuminate\View\View|object
     */
    public function reset($id, Request $req)
    {
        User::where('id', $id)
            ->update([
                'password' => Hash::make(1234567890),
            ]);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(7),
            true,
            User::find($id)
        );

        return Redirect::route('users.index')
            ->with([
                'status' => 'Password untuk pengguna ' . User::find($id)->name . ' telah diganti menjadi \'1234567890\'',
                'type' => 'success',
            ]);
    }

    /**
     * Change name the given user.
     *
     * @param Request $req
     * @return \Illuminate\View\View|object
     */
    public function changeName(Request $req)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = User::find(Auth::user()->id);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(0, true, 'Mengganti nama ' . $user->name . ' menjadi ' . $req->name),
            true,
            $user
        );

        $oldName = $user->name;
        $user->name = $req->name;
        $user->save();

        return Redirect::route('dashboard')
            ->with([
                'status' => 'Nama berhasil diganti dari ' . $oldName . ' menjadi ' . $req->name,
                'type' => 'success',
            ]);
    }

    /**
     * Show the change password.
     *
     * @return \Illuminate\View\View
     */
    public function changePassword()
    {
        return view('auth.forgot-password');
    }
}
