<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;
use App\Admins;

class Admin extends Middleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards) {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        http_response_code(404);
		return null;
        // return redirect(env('APP_PROXY'));
        // return redirect()->route('login', [session()->getId()]);
    }
}
