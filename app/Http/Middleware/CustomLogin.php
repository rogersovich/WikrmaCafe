<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CustomLogin
{

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        dd($user);
        return $next($request);
    }
}
