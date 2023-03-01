<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolesRequest;
use App\Models\Role;
use App\Services\DataService;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;

class RoleController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->ajax()) {
            // $data = Role::where('id', '!=', Auth::role()->id)->get();
            $data = Role::select('id','role_name')->get();

            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">';
                    $actionBtn .= '<button type="button" class="btn btn-md btn-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown">
                            <small class="sr-only">Toggle Dropdown</small>
                        </button>';
                    $actionBtn .= '<div class="dropdown-menu">
                            <a class="dropdown-item" href="' . route('roles.edit', $row->id) . '">Edit</a>';
                    $actionBtn .= '<a id="'.$row->id.'" class="delete dropdown-item" style="cursor:pointer;">Hapus</a>';
                    $actionBtn .= '</div></div>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.backend.data.roles.viewRoles');
    }

 /**
 * Store a new role.
 *
 * @param RolesRequest $req
 * @param DataService $dataService
 * @return JsonResponse
 */
public function store(RolesRequest $req, DataService $dataService)
{
    $performedOn = $dataService->create($req->validated(), new Role());
    
    // Create Log
    $this->createLog(
        $req->header('user-agent'),
        $req->ip(),
        $this->getStatus(3),
        true,
        Role::find($performedOn->original['id'])
    );

    return Response::json([
        'status' => 'success',
        'data' => 'Berhasil membuat Role baru',
    ]);
}

/**
 * Show the roles dashboard.
 *
 * @return \Illuminate\View\View
 */
public function create()
{
    return view('pages.backend.data.roles.createRoles');
}

/**
 * Show the roles dashboard.
 *
 * @return mixed
 */
public function edit($id)
{
    $role = Role::find($id);

    return view('pages.backend.data.roles.updateRoles', [
        'role' => $role,
    ]);
}

/**
 * Delete the given role.
 *
 * @param Request $req
 * @param string $id
 * @param RoleService $roleService
 * @return \Illuminate\Http\Response
 */
public function destroy(Request $req, $id, RoleService $roleService)
{
    $roleService->deleteRole($id);

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
 * Show the recycle roles.
 *
 * @param Request $req
 * @return mixed
 */
public function recycle(Request $req)
{
    if ($req->ajax()) {
        $data = Role::onlyTrashed()->get();

        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                $actionBtn = '<button id="'.$row->id.'" class="restore btn btn btn-primary
            btn-action mb-1 mt-1 mr-1">Kembalikan</button>';
                $actionBtn .= '<button id="'.$row->id.'" class="delRecycle btn btn-danger
                btn-action mb-1 mt-1">Hapus</button>';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('pages.backend.data.roles.recycleRoles');
}

/**
 * Restore the given role.
 *
 * @param string $id
 * @param Request $req
 * @param RoleService $roleService
 * @return \Illuminate\Http\Response
 */
public function restore($id, Request $req, RoleService $roleService)
{
    $roleService->restoreRole($id);

    // Create Log
    $this->createLog(
        $req->header('user-agent'),
        $req->ip(),
        $this->getStatus(6),
        true,
        Role::find($id)
    );

    return Response::json(['status' => 'success']);
}

/**
 * Restore all roles.
 *
 * @param Request $req
 * @param RoleService $roleService
 * @return \Illuminate\Http\Response
 */
public function restoreAll(Request $req, RoleService $roleService)
{
    $roleService->restoreAll();

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
 * Delete permanently the given role.
 *
 * @param string $id
 * @param Request $req
 * @param RoleService $roleService
 * @return \Illuminate\Http\Response
 */
public function delete($id, Request $req, RoleService $roleService)
{
    $roleService->deleteRoleRecycle($id);

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
 * Delete permanently all roles.
 *
 * @param Request $req
 * @param RoleService $roleService
 * @return \Illuminate\Http\Response
 */
public function deleteAll(Request $req, RoleService $roleService)
{
    $roleService->deleteAllRoleRecycle();

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
 * Update the given role.
 *
 * @param string $id
 * @param App\Http\Requests\RolesRequest $req
 * @param RoleService $roleService
 * @return \Illuminate\Http\Response
 */
public function update($id, RolesRequest $req, RoleService $roleService)
{
    $roleService->updateRole($id, $req->validated());

    // Create Log
    $this->createLog(
        $req->header('user-agent'),
        $req->ip(),
        $this->getStatus(4),
        true,
        Role::find($id)
    );

    return Response::json([
        'status' => 'success',
        'data' => 'Berhasil Mengubah Role',
    ]);
}

}
