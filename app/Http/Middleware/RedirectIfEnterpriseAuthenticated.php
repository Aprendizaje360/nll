<?php

namespace App\Http\Middleware;

use Closure;

//Auth Facade
use Auth;

class RedirectIfEnterpriseAuthenticated
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
        //If request comes from logged in user, he will
        //be redirect to home page.
        if (Auth::check()) {
            $request->session()->flash('danger', 'Necesita cerrar sesion para acceder a la página');
            return redirect('/home');
        }

        //If request comes from logged in seller, he will
        //be redirected to seller's home page.
        if (Auth::guard('web_admin')->check()) {
            $request->session()->flash('danger', 'Necesita cerrar sesion para acceder a la página');
            return redirect('/admin_home');
        }

        return $next($request);
    }
}
