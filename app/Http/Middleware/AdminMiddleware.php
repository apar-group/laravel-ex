<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Foundation\Auth\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (! $user || $user->level <= \App\User::USER) {
            Auth::logout();
            return redirect("/admin/login")->with('message', trans('user.login_first'));
        }

        if (! Auth::user()->confirmed) {
            Auth::logout();
            return redirect("/admin/login")->with('message', trans('user.check_and_verify_email'));
        }

        return $next($request);
    }
}
