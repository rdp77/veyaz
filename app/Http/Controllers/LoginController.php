<?php

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                $user->loadMissingRelationships('roles');
                $user->append('password');
            } else {
                $user->makeHidden('password');
            }


            $token = $user->createToken('Token Name')->plainTextToken;

            return response()->json([
                'user' => $user->with('roles'),
                'token' => $token,
            ]);
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password',
        ]);
    }
}