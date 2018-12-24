<?php

namespace App\Http\Middleware;

use Closure;

class AccessDenied
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
        $urlDenied = ['/register', '/password/email'];
        $bool = true;
        $url = $_SERVER['REQUEST_URI'];
        foreach ($urlDenied as $item) {
            if ($item === $url) {
                $bool = false;
                break;
            }
        }
        if (!$bool) {
            abort(404);
        } else {
            return $next($request);
        }
    }
}
