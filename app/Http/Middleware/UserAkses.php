<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$levels
     * @return mixed
     */
    public function handle($request, Closure $next, ...$levels)
    {
        if (in_array(auth()->user()->level, $levels)) {
            return $next($request);
        }
        return response()->json(['Tidak Mempunyai Akses.']);
    }
}
