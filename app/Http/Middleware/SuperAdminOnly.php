<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminOnly
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
        //If request does not comes from logged in seller
        //then he shall be redirected to Seller Login page
        if (! \Auth::guard('web_admin')->check()) 
        {
            return redirect()->guest('/admin_login');
        }

        $authuser = \Auth::guard('web_admin')->user();

        if (!$authuser->hasRole('superadmin')) 
        {
            return redirect()->guest('/admin_login');
        }

        return $next($request);
    }
}
