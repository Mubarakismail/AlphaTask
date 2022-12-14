<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class languageApiMiddleware
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
        $lang = $request->header('lang');
        $lang = (!$lang ? 'en' : $lang);
        App::setLocale($lang);
        return $next($request);
    }
}
