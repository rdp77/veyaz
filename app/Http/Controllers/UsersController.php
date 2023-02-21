<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\DataService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the users dashboard.
     *
     * @param Request $req
     * @return mixed
     * @throws Exception
     */
    public function index(Request $req)
    {
        $data = User::all();
        if ($req->ajax()) {
            $data = User::where('id', '!=', Auth::user()->id)->get();

            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">';
                    $actionBtn .= '<a onclick="reset(' . $row->id . ')" class="btn btn-primary text-white" style="cursor:pointer;">Reset Password</a>';
                    $actionBtn .= '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>';
                    $actionBtn .= '<div class="dropdown-menu">
                            <a class="dropdown-item" href="' . route('users.edit', $row->id) . '">Edit</a>';
                    $actionBtn .= '<a onclick="del(' . $row->id . ')" class="dropdown-item" style="cursor:pointer;">Hapus</a>';
                    $actionBtn .= '</div></div>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.index', ['data' => $data]);
    }

    /**
     * Store a new user.
     *
     * @param UsersRequest $req
     * @param DataService $dataService
     * @return JsonResponse
     */
    public function store(Request $req, DataService $dataService)
    {
        $role = Role::find($req->role);
        $req->validate([
            'username' => ['required'],
            'email' => ['required'],
            'role' => ['required'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);
//        $performedOn = $userService->createUser($req->validated());
        // $performedOn = $dataService->create($req->validated(), new User());
        try {
            $performedOn = User::create([
                'name' => $req->name,
                'username' => $req->username,
                'email' => $req->email,
                'password' => Hash::make($req->password)
            ]);
            $role = Role::find($req->role);
            if($performedOn) $performedOn->assignRole($role->name);
            // Create Log
            $this->createLog(
                $req->header('user-agent'),
                $req->ip(),
                $this->getStatus(3),
                true,
                User::find($performedOn->id)
            );
    
            return redirect()->back()->with('createUser', 'Sucessfully Created New User');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $role = Role::all();
        return view('users.create', ['role' => $role]);
    }

    /**
     * Show the users dashboard.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();

        return view('users.edit', [
            'user' => $user,
            'role' => $role
        ]);
    }

    /**
     * Delete the given user.
     *
     * @param Request $req
     * @param string $id
     * @param UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id, UserService $userService)
    {
        $userService->deleteUser($id);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(5),
            false
        );

        return redirect()->back()->with('deleteUser', "success delete user");
    }

    /**
     * Show the recycle users.
     *
     * @param Request $req
     * @return mixed
     */
    public function recycle(Request $req)
    {
        if ($req->ajax()) {
            $data = User::onlyTrashed()->get();

            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button onclick="restore(' . $row->id . ')" class="btn btn btn-primary
                btn-action mb-1 mt-1 mr-1">Kembalikan</button>';
                    $actionBtn .= '<button onclick="delRecycle(' . $row->id . ')" class="btn btn-danger
                    btn-action mb-1 mt-1">Hapus</button>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.backend.data.users.recycleUsers');
    }

    /**
     * Restore the given user.
     *
     * @param string $id
     * @param Request $req
     * @param UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function restore($id, Request $req, UserService $userService)
    {
        $userService->restoreUser($id);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(6),
            true,
            User::find($id)
        );

        return Response::json(['status' => 'success']);
    }

    /**
     * Restore all users.
     *
     * @param Request $req
     * @param UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(Request $req, UserService $userService)
    {
        $userService->restoreAll();

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(6),
            false
        );

        return Response::json(['status' => 'success']);
    }

    /**
     * Delete permanently the given user.
     *
     * @param string $id
     * @param Request $req
     * @param UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $req, UserService $userService)
    {
        $userService->deleteUserRecycle($id);

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(5),
            false
        );

        return Response::json(['status' => 'success']);
    }

    /**
     * Delete permanently all users.
     *
     * @param Request $req
     * @param UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $req, UserService $userService)
    {
        $userService->deleteAllUserRecycle();

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(6),
            false
        );

        return Response::json(['status' => 'success']);
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
     * Update the given user.
     *
     * @param string $id
     * @param App\Http\Requests\UsersRequest $req
     * @param UserService $userService
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $req, UserService $userService)
    {
        $user = User::find($id);
        $role = Role::find($req->role);


        try {
            $user->update([
                'name' => $req->name,
                'username' => $req->username,
                'email' => $req->email
            ]);
            $user->removeRole($user->roles[0]->name);
            $user->assignRole($role->name);
    
            // Create Log
            $this->createLog(
                $req->header('user-agent'),
                $req->ip(),
                $this->getStatus(4),
                true,
                User::find($id)
            );
    
            return redirect()->back()->with('updateUser', "Successfully Updated User");
        } catch (\Throwable $th) {
            //throw $th;
        }
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
    public function changePassword($id)
    {
        $user = User::find($id);

        return view('users.change-password', ['user' => $user]);
    }

    public function updatePassword($id, Request $req)
    {
        $user = User::findOrFail($id);

        $req->validate([
            'existing_password' => ['required'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        try {

            if(Hash::check($req->existing_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($req->password)
                ]);

                return redirect()->back()->with('updatePassword', 'Password is updated');
            }else {
                return redirect()->back()->with('errorExistingPassword', 'Existing password is incorrect.');;
            }

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function getPassword()
    {
        $user = Auth::user();
        if($user->hasRole('Admin')){
            return response()->json([
                'password' => $user->getAuthPassword()
            ]);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
