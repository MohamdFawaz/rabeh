<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->headers->get('locale');
        if ($locale){
            app()->setLocale($locale);
        }else{
            app()->setLocale('en');
        }
        return $next($request);
    }
}
