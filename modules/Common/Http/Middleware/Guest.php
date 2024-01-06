<?php

namespace Modules\Common\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();

        if (Auth::guard('admin_web')->check() && ($path == 'panel/auth/login' || $path == 'panel/auth/register')) {
            return redirect()->route('dashboard');
        }

        if (Auth::guard('web')->check()) {
            return redirect()->route('not_found');
        }

        return $next($request);
    }
}
