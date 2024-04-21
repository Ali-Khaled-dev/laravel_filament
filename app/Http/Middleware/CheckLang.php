<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLang
{
    public function handle(Request $request, Closure $next): Response
    {
        $local = $request -> lang ? $request -> lang : 'en' ;

        app()->setLocale($local);

        return $next($request);
    }
}
