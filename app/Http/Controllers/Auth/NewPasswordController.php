<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __construct(DashboardController $DashboardController)
    {
        $this->DashboardController = $DashboardController;
    }

    public function create(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    public function changePassword(Request $req)
    {
        $this->validate($req, [
            'oldPassword' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['required', 'string'],
        ]);

        if (Auth::user()->username != $req->username) {
            return redirect()->route('users.password')
                ->with([
                    'status' => 'Username sebelumnya tidak sama silahkan cek kembali',
                    'type' => 'error'
                ]);
        }

        $user = User::find(Auth::user()->id);

        if (Hash::check($req->oldPassword, Auth::user()->password)) {
            $user->password = Hash::make($req->password);
            $user->save();

            $this->DashboardController->createLog(
                $req->header('user-agent'),
                $req->ip(),
                'Mengganti password'
            );

            Auth::logout();

            return Redirect::route('login');
        } else {
            return redirect()->route('users.password')
                ->with([
                    'status' => 'Password sebelumnya tidak sama silahkan cek kembali',
                    'type' => 'error'
                ]);
        }
    }
}
