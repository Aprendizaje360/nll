<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfAdminAuthenticated
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
      if (Auth::guard()->check()) {
          $request->session()->flash('danger', 'Necesita cerrar sesion para acceder a la página');
          return redirect('/home');
      }

      //If request comes from logged in enterprise, he will
      //be redirect to home page.
      if (Auth::guard('web_enterprise')->check()) {
          $request->session()->flash('danger', 'Necesita cerrar sesion para acceder a la página');
          return redirect('/enterprise_home');
      }

      return $next($request);
    }
}
