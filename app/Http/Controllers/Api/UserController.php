<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Concerns\HidesAttributes;

class UserController extends Controller
{

    public function index(){
        //restricted show password
        if (Gate::allows('isAdmin')) {
            $users = User::latest()->paginate(5);
        } else {
            $users = User::latest()->paginate(5);
            $users->makeHidden(['password']);
        }   
        //return collection of users as a resource
        return new UserResource(true, 'List Data Users', $users);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required|min:3',
            'username'     => 'required|min:3',
            'email'   => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        //create user
        $user = User::create([
            'name'       => $data['name'],
            'username'   => $data['username'],
            'email'      => $data['email'],
            'password'   => $data['password'],
        ]);

        //return response
        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $user);
    }

    public function show(User $user)
    {
        //return single user as a resource
        return new UserResource(true, 'Data User Ditemukan!', $user);
    }

    public function update(Request $request, User $user)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'username'     => 'required',
            'email'   => 'required',
            'password' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user->update([
            'name'       => $data['name'],
            'username'   => $data['username'],
            'email'      => $data['email'],
            'password'   => $data['password'],
        ]);

        //return response
        return new UserResource(true, 'Data User Berhasil Diubah!', $user);
    }

    public function destroy(User $user)
    {
        //delete user
        $user->forceDelete();
        //return response
        return new UserResource(true, 'Data User Berhasil Dihapus Permanen', null);
    }

    public function softDelete(User $user){
        $user->trashed();
        return new UserResource(true, 'Data User Berhasil Dihapus Sementara', null);
    }

    public function restore(User $user){
        $user->restore();
        return new UserResource(true, 'Data User Berhasil Dikembalikan', null);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user= User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'success'   => false,
                    'message' => ['These credentials do not match our records.']
                ], 404);
        }
        
        $token = $user->createToken('ApiToken')->plainTextToken;
        
        $response = [
                'success'   => true,
                'user'      => $user,
                'token'     => $token
        ];
        
        return new UserResource(true, 'Login Berhasil', $response);
    }
}
