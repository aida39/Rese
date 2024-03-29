<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class UserEnsureEmailIsVerified
{
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if ($request->user() && $request->user() instanceof MustVerifyEmail && !$request->user()->hasVerifiedEmail()) {
            Auth::logout();
            return redirect('email/verify');
        }
        return $next($request);
    }
}
