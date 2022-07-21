<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Core\MainController;
use App\Http\Requests\UsersRequest;
use App\Models\Template\ActivityList;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class ArticlesController extends Controller
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
    }

    public function create()
    {
    }

    public function store(UsersRequest $req, UserService $userService)
    {
    }

    public function edit($id)
    {
    }

    public function update($id, UsersRequest $req, UserService $userService)
    {
    }

    public function destroy(Request $req, $id, UserService $userService)
    {
    }

    public function recycle(Request $req)
    {
    }

    public function restore($id, Request $req, UserService $userService)
    {
    }

    public function restoreAll()
    {
    }

    public function delete($id, Request $req, UserService $userService)
    {
    }

    public function deleteAll(Request $req, UserService $userService)
    {
    }

    protected function getStatus($type, $custom = false, $message = null)
    {
        return $custom ? $message : ActivityList::find($type)->name;
    }
}