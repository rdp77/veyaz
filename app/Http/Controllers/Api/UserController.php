<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use Exception;

class UserController extends Controller
{
    function index(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email'     => 'required|email',
        ]);

        if($validate->fails())
            return $this->response()->fail(401);

        $response = $this->user->checkAdminOrFail($request);

        return $this->response($response)->success(200);
    }
}
