<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //libre accès pour admin
        if(auth()->user()->role->name==='admin')
            return $next($request);

        $routeActuel=$request->route()->getName();

        $listRoutes=auth()->user()->role->permissions->toArray();
        //voir la configuration dans kernel
        foreach ($listRoutes as $route){
            if ($route['name']===$routeActuel)
                return $next($request);
        }
        abort(403,'Accès interdit | Vous n\'êtes pas autorisé d\'éffectuer cette Action !');
    }
}
