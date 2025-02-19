<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
{
    if (Auth::check() && Auth::user()->is_admin === 1) {
        return $next($request);
    }

    return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}
}
 