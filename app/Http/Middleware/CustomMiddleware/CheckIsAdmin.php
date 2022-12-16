<?php

namespace App\Http\Middleware\CustomMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // if($user->isAdmin) {
        //     return redirect()->route('admin');
        // }
        // else {
        //     return $next($request);
        // }

        // if(!$user->isAdmin) {
        //     return redirect()->route('user');
        // }
        // else {
        //     // return $next($request);
        // }
        
            return $next($request);
    }
}
