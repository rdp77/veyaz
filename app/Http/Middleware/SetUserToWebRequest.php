<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetUserToWebRequest
{

    const NAME =  'app.http.middleware.set-user-to-web-request';

    protected  UserRepository $userRepository;

    /**
     * Undocumented function
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        
        $user = $this->userRepository->find(Auth::user()->id);
        $request->setCurrentUser($user);
        return $next($request);
    }
}
