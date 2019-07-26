<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
        if(Auth::user()->role != 'Admin') {
            if($request->wantsJson()){
                return response()->json(['error' => 'Unauthorized']);
            }
            return redirect(route('home'));
        }
        return $next($request);
    }
}
