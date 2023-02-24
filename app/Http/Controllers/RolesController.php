<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DataTables\RolesDataTable;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    //
    public function index()
    {
        $roles = Roles::all();
        return view('pages.roles.index', compact('roles'));
    }

    public function list()
    {
        $roles = Roles::latest()->get();
        return DataTables::of($roles)
            ->addColumn('action', function ($row) {
                return '<div>' .
                    '<a href="javascript:void(0);" class="ml-2 btn btn-icon bs-tooltip font-20 text-muted" onclick="view('.$row->id.')" title="Edit"><i class="bi bi-pen"></i></a>' .
                    '<a href="javascript:void(0);" class="ml-2 btn btn-icon bs-tooltip font-20 text-primary"  onclick="remove('.$row->id.')"title="Delete"><i class="bi bi-trash"></i></a>' .
                    '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'status'            => 'required|numeric',
            'roleId'            => 'required_if:status,1',
            'name'              => 'required|string',
        ]);
        if ($validator->fails()){
            $data = [
                'status'    => FALSE,
                'message'   => 'Form yang anda kirim tidak valid / kurang sesuai',
            ];
            return response()->json($data);
        }
        try{
            $data = $request->all();
            $data += [
                'notes' => $data['name']
            ];
            $role = Roles::updateOrCreate(['id'=>$data['roleId']], $data);

            $data = [
                'status'    => true,
                'message'   => 'Berhasil simpan data Role',
                'role'  => $role
            ];
            return response()->json($data);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            $data = [
                'status'    => FALSE,
                'message'   => 'Gagal simpan data Role',
            ];
            return response()->json($data);
        }
    }

    public function show($roleId)
    {
        $role = Roles::find($roleId);
        if ($role){
            $data = [
                'status'    => true,
                'data'      => $role
            ];
        }else{
            $data = [
                'status'    => true,
                'message'   => 'Data role tidak tersedia'
            ];
        }
        return response()->json($data);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'RoleId' => ['required','numeric']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Form tidak valid'
            ]);
        }

        try {
            $roles = Roles::where('id', $request->RoleId)->first();
            if ($roles === null) {
                return response()->json([
                    'status' => false,
                    'message' => "Role can't find"
                ]);
            }
            $roles->delete();
            return response()->json([
                'status' => true,
                'message' => 'Role deleted'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete Role '. $th->getMessage()
            ]);
        }
    }
}
