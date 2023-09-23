<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 'admin')
        {
            return $next($request);
        }else{
            return redirect()->route(auth()->user()->role)->with('error','You Dont Have Access ');
        }
    }
}
