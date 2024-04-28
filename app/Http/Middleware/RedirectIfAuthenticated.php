<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? ['web'] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'web':
                        return redirect()->route('admin.dashboard'); // Redirect admin dashboard
                    case 'doctor':
                        return redirect()->route('doctor.dashboard'); // Redirect doctor dashboard
                    case 'receptionist':
                        return redirect()->route('receptionist.dashboard'); // Redirect receptionist dashboard
                    case 'account':
                        return redirect()->route('account.dashboard'); // Redirect account dashboard
                }
            }
        }

        return $next($request);
    }

}
