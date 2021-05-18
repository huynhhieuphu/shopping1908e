<?php

namespace App\Http\Middleware;

use Closure;

class checkRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /*
     * $params : là tham số truyền vào
     * */
    public function handle($request, Closure $next, $params)
    {
        if($params !== 'admin'){
            return redirect(route('permit'));
        }
        return $next($request);
    }
}
