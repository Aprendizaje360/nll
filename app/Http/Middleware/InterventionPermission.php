<?php

namespace App\Http\Middleware;

use Closure;

class InterventionPermission
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
        $user = \Auth::guard('web_enterprise')->user();

        $intervention = $request->route('intervention');

        $interventions = $user->interventions()->wherePivot('has_permission', true)
                               ->wherePivot('intervention_id', $intervention->id)
                               ->get();

        if ($interventions->isEmpty())
        {
            $request->session()->flash('danger', 'No tiene permiso para entrar a esta intervencion');

            return back();
        }

        return $next($request);
    }
}
