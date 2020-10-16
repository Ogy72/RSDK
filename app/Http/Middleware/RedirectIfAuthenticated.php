<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //return redirect(RouteServiceProvider::HOME);
            if(Gate::allows('isAdminRm')) {
                return redirect('/data-pasien');
            } else if(Gate::allows('isPerawat')){
                return redirect('/rekam-medis');
            } else{
                return redirect('/data-keuangan');
            }
        }

        return $next($request);
    }
}
