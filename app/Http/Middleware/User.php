<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{

    public function handle(Request $request, Closure $next): Response
    {
//        if (auth()->user()->role == 'user')
//        {
//            return $next($request);
//        }else{
//            return redirect()->route(auth()->user()->role)->with('error','You Dont Have Access ');
//        }
        if (empty(session('user')))
        {
            return redirect()->route('user.auth');
        }
        else
        {
            return $next($request);

        }
    }
}
