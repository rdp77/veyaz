<?php

namespace App\Http\Controllers;

use App\Common\UserDatatable;
use App\Entities\MyUser;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use App\Queries\UserQuery;
use App\Services\DataService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Repositories\ScopeRepository;
use App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{

    /**
     * @var UserDatatable
     */
    protected UserDatatable $userDatatable;
    
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var ScopeRepository
     */
    protected ScopeRepository $scopeRepository;

    /**
     * @var EntityUnit
     */
    protected EntityUnit $eu;

    /**
     * Undocumented function
     *
     * @param UserDatatable $userRepository
     */
    public function __construct(
        UserDatatable $userDatatable,
        UserRepository $userRepository,
        ScopeRepository $scopeRepository,
        EntityUnit $eu
    )
    {
        $this->middleware('auth');
        $this->userDatatable = $userDatatable;
        $this->userRepository = $userRepository;
        $this->scopeRepository = $scopeRepository;
        $this->eu = $eu;
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
            return $this->userDatatable->populate();
        }


        return view('user.index');
    }

    /**
     * Store a new user.
     *
     * @param Request $req
     * @param DataService $dataService
     * @return JsonResponse
     */
    public function store(Request $req, DataService $dataService)
    {

        return redirect('data/users');
    }

    /**
     * Show the users dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $scopes = $this->scopeRepository->collect();
        return view('user.add', compact('scopes'));
    }

    /**
     * Show the users dashboard.
     *
     * @return mixed
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $scopes = $this->scopeRepository->collect();

        return view('user.edit', compact('user', 'scopes'));
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
        $resource = $req->getResource();

        $resource->setIsDeleted(true);

        $this->eu->preparePersistence($resource);
        $this->eu->flush();

        return redirect('data/users');
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
        
        return redirect('data/users');
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
