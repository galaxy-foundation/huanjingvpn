<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $locale='zh';
        if(session()->has('lang')) $locale=session()->get('lang');
        \App::setlocale($locale);
        return $next($request);
    }
}
