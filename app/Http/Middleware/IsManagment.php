<?php


namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsManagment
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
        if (Auth::user()->user_type == 'super-admin' ||
            Auth::user()->user_type == 'manager' ||
            Auth::user()->user_type == 'rider')
        {
            return $next($request);
        }
        return response()->json(['message'=> 'You are not authorized person.']);
    }
}
