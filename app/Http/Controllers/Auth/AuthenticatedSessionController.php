<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Core\MainController;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function __construct(MainController $MainController)
    {
        $this->MainController = $MainController;
    }

    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $this->createLog($request->header('user-agent'), $request->ip(), 1);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->createLog($request->header('user-agent'), $request->ip(), 2);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function createLog($userAgent, $ip, $type, $custom = false, $desc = null, $message = null)
    {
        switch ($type) {
            case 1:
                $status = "melakukan login";
                break;
            case 2:
                $status = "melakukan logout";
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