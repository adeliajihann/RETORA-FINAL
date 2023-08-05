<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $rules)
    {
        if (!Auth::check()) {
            // controller login
            return redirect("login");
        }

        $users = Auth::user();
        if ($users->role == $rules) {
            return $next($request);
        }

        return redirect("login")->with("error", "Anda tidak memiliki akses!");
        return $next($request);
    }
}