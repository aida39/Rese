<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class ManagerEnsureEmailIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if ($request->user('managers') && $request->user('managers') instanceof MustVerifyEmail && !$request->user('managers')->hasVerifiedEmail()) {
            Auth::logout();
            return redirect('/manager/email/verify');
        }

        return $next($request);
    }
}
