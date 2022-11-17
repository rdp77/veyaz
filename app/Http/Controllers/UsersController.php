<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
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

        return view('dashboard');
    }

    /**
     * Store a new user.
     *
     * @param UsersRequest $req
     * @param DataService $dataService
     * @return JsonResponse
     */
    public function store(UsersRequest $req, DataService $dataService)
    {
//        $performedOn = $userService->createUser($req->validated());
        $performedOn = $dataService->create($req->validated(), new User());
        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(3),
            true,
            User::find($performedOn->id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil membuat pengguna baru',
        ]);
    }

    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.backend.data.users.createUsers');
    }

    /**
     * Show the users dashboard.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('pages.backend.data.users.updateUsers', [
            'user' => $user,
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

        return Response::json(['status' => 'success']);
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
    public function update($id, UsersRequest $req, UserService $userService)
    {
        $userService->updateUser($id, $req->validated());

        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(4),
            true,
            User::find($id)
        );

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah pengguna',
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
