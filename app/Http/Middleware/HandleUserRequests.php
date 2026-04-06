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

        // check if the user is not manager, then automatically redirect it to the employee dashboard
        if($user->role !== 'manager') {
            return redirect()->route('employee.dashboard');
        }

        // Otherwise, redirect it to the manager role.
        return $next($request);
    }

}
