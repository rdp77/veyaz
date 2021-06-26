<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashboardController $DashboardController)
    {
        $this->middleware('auth');
        $this->DashboardController = $DashboardController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)
            ->get();
        return view('pages.backend.users.indexUsers', ['users' => $users]);
    }

    public function create()
    {
        return view('pages.backend.users.createUsers');
    }

    public function store(Request $req)
    {
        Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        User::create([
            'name' => $req->name,
            'username' => $req->username,
            'password' => Hash::make($req->password),
        ]);

        $this->DashboardController->createLog(
            $req->header('user-agent'),
            $req->ip(),
            'Membuat user baru'
        );

        return Redirect::route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.data.users.updateUsers', ['user' => $user]);
    }

    public function update($id, Request $req)
    {
        Validator::make($req->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
        ])->validate();

        $user = User::find($id);
        $user->name = $req->name;
        $user->username = $req->username;
        $user->save();
        return Redirect::route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return Redirect::route('users.index');
    }

    function reset($id)
    {
        $user = User::find($id);
        $user->password = Hash::make(1234567890);
        $user->save();
        return Redirect::route('users.index')
            ->with([
                'status' => 'Password untuk user ' . $user->name . ' telah diganti menjadi \'1234567890\''
            ]);
    }

    public function changeName(Request $req)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255']
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $req->name;
        $user->save();
        return redirect()->route('dashboard');
    }

    public function changePassword()
    {
        return view('auth.forgot-password');
    }
}
