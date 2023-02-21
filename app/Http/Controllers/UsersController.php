<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
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
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('user.index', ['trashed' => false]);
    }

    /**
     * Store a new user.
     *
     * @param UsersRequest $req
     * @param UserService $userService
     * @return JsonResponse
     */
    public function store(UsersRequest $req, UserService $userService)
    {
//        $performedOn = $userService->createUser($req->validated());
        $performedOn = $userService->createUser($req->validated());
        // Create Log
        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            $this->getStatus(3),
            true,
            User::find($performedOn->id)
        );

        return to_route('users.index')->with('status', 'Berhasil tambah user');
    }

    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Show the users dashboard.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', [
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

        return to_route('users.index')->with('status', 'Berhasil hapus user');
    }

    /**
     * Show the recycle users.
     *
     * @param Request $req
     * @return mixed
     */
    public function recycle(Request $req)
    {
        $dataTable = app(UsersDataTable::class, ['trashed' => true]);

        return $dataTable->render('user.index', ['trashed' => true]);
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

        return to_route('users.recycle')->with('status', 'Berhasil mengembalikan user');
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

        return to_route('users.recycle')->with('status', 'Berhasil mengembalikan semua user');
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

        return to_route('users.recycle')->with('status', 'Berhasil hapus user');
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

        return to_route('users.recycle')->with('status', 'Berhasil hapus semua user');
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

        return to_route('users.index')
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

        return to_route('users.index')->with('status', 'Berhasil edit user');
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
