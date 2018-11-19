<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Detect current site and set the cache prefix
 */
class HydrateCurrentSite
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
        app('site'); // Instantiates CurrentSite
        return $next($request);
    }
}
