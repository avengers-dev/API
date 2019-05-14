<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Controller;
use App\Models\GiangViens;
class ValidateToken
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
        $flag = GiangViens::validateToken($request->token);
        if (!$flag) {
            return (new Controller())->responses([], 404, trans('messages.api_fail'));
        }
        return $next($request);
    }
}
