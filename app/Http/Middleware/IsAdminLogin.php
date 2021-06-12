<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Http\Request;

class IsAdminLogin
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
        if($this->checkIsLogin($request)){
            return redirect()->route('admin.dashboard.index');
        }

        return $next($request);
    }

    private function checkIsLogin($request)
    {
        $session_id = $request->session()->get('id_username');
        return is_numeric($session_id) && $session_id > 0 ? true : false;
    }
}
