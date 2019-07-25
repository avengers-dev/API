<?php

namespace App\Http\Middleware;

use Closure;
session_start();
class TokenAdmin 
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
    
        if (session()->has('taikhoan')) {
            return $next($request);
            
        }else{
            return redirect()->route('login');
        }
        
    }
}
