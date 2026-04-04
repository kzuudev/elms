<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleUserRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 1. If an EMPLOYEE is trying to access a MANAGER route, kick them to their dashboard
        if ($user && $user->role !== 'manager' && $request->routeIs('manager.*')) {
            return redirect()->route('employee.dashboard');
        }

        // 2. If a MANAGER is trying to access an EMPLOYEE route, kick them to their dashboard
        if ($user && $user->role === 'manager' && $request->routeIs('employee.*')) {
            return redirect()->route('manager.dashboard');
        }

        // 3. If they are exactly where they are supposed to be, open the door!
        return $next($request);
    }

}
