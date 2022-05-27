<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\MainController;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MainController $MainController)
    {
        $this->middleware('auth');
        $this->MainController = $MainController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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

        return view('pages.backend.data.users.indexUsers');
    }

    public function create()
    {
        return view('pages.backend.data.users.createUsers');
    }

    public function store(UsersRequest $req)
    {
        $validated = $req->validated();
        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'created_by' => Auth::user()->name,
            'updated_by' => '',
            'deleted_by' => ''
        ]);

        $this->createLog($req->header('user-agent'), $req->ip(), 1);

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil membuat pengguna baru'
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.backend.data.users.updateUsers', ['user' => $user]);
    }

    public function update($id, UsersRequest $req)
    {
        $createdBy = User::find($id)->created_by;

        User::where('id', $id)
            ->update([
                'name' => $req->name,
                'username' => $req->username,
                'created_by' => $createdBy,
                'updated_by' => Auth::user()->name
            ]);

        $this->createLog($req->header('user-agent'), $req->ip(), 2, false, User::find($id)->name);

        return Response::json([
            'status' => 'success',
            'data' => 'Berhasil mengubah pengguna'
        ]);
    }

    public function destroy(Request $req, $id)
    {
        $user = User::find($id);
        $user->deleted_by = Auth::user()->name;
        $user->save();

        User::destroy($id);

        $this->createLog($req->header('user-agent'), $req->ip(), 3);

        return Response::json(['status' => 'success']);
    }

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

    public function restore($id, Request $req)
    {
        User::onlyTrashed()
            ->where('id', $id)
            ->restore();

        $user = User::find($id);
        $user->deleted_by = '';
        $user->save();

        $this->createLog($req->header('user-agent'), $req->ip(), 4);

        return Response::json(['status' => 'success']);
    }

    public function delete($id, Request $req)
    {
        User::onlyTrashed()
            ->where('id', $id)
            ->forceDelete();

        $this->createLog($req->header('user-agent'), $req->ip(), 5);

        return Response::json(['status' => 'success']);
    }

    public function deleteAll(Request $req)
    {
        $user = User::onlyTrashed()
            ->forceDelete();

        if ($user == 0) {
            return Response::json([
                'status' => 'error',
                'data' => "Tidak ada data di recycle bin"
            ]);
        } else {
            $user;
        }

        $this->createLog($req->header('user-agent'), $req->ip(), 6);

        return Response::json(['status' => 'success']);
    }

    function reset($id, Request $req)
    {
        User::where('id', $id)
            ->update([
                'password' => Hash::make(1234567890),
            ]);

        $this->createLog($req->header('user-agent'), $req->ip(), 7, false, User::find($id)->name);

        return Redirect::route('users.index')
            ->with([
                'status' => 'Password untuk pengguna ' . User::find($id)->name . ' telah diganti menjadi \'1234567890\'',
                'type' => 'success'
            ]);
    }

    public function changeName(Request $req)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255']
        ]);

        $user = User::find(Auth::user()->id);

        $this->createLog(
            $req->header('user-agent'),
            $req->ip(),
            0,
            true,
            null,
            'Mengganti nama ' . $user->name . ' menjadi ' . $req->name
        );

        $oldName = $user->name;
        $user->name = $req->name;
        $user->save();

        return Redirect::route('dashboard')
            ->with([
                'status' => 'Nama berhasil diganti dari ' . $oldName . ' menjadi ' . $req->name,
                'type' => 'success'
            ]);
    }

    public function changePassword()
    {
        return view('auth.forgot-password');
    }

    protected function createLog($userAgent, $ip, $type, $custom = false, $desc = null, $message = null)
    {
        switch ($type) {
            case 1:
                $status = "membuat pengguna baru";
                break;
            case 2:
                $status = "mengubah pengguna";
                break;
            case 3:
                $status = "menghapus data pengguna ke recycle bin";
                break;
            case 4:
                $status = "mengembalikan data pengguna";
                break;
            case 5:
                $status = "menghapus data pengguna secara permanen";
                break;
            case 6:
                $status = "menghapus semua data pengguna secara permanen";
                break;
            case 7:
                $status = "reset password pengguna";
                break;
            default:
                $status = "";
                break;
        }

        $this->MainController->createLog(
            $userAgent,
            $ip,
            $custom ? $message : Auth::user()->name . ' ' . $status . ' ' . $desc,
        );
    }
}