<?php

namespace App\Http\Middleware;

use Closure;

//Auth Facade
use Auth;

class AuthenticateEnterprise
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
        if (! Auth::guard('web_enterprise')->check()) {
           return redirect('/enterprise_login');
        }

        return $next($request);
    }
}
