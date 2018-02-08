<?php

namespace App\Http\Middleware;

use Closure;

class DisableZRay
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
        zray_disable(true);
        
        return $next($request);
    }
}
