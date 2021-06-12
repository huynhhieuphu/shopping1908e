<?php

namespace App\Http\Middleware;

use Closure;

//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Session;

class checkLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        // giả sử: người dùng nhập đường http://127.0.0.1:8001/admin/brand lấy Route name: 'admin.brand.index'
//        $name = Route::currentRouteName(); // lấy ra Route name từ $uri
//
//        if ($name === 'admin.login.form') {
//            if ($this->checkSessionAdmin()) {
//                // vào trang dashboard luôn - vì đăng nhập rồi
//                return redirect()->route('admin.dashboard.index');
//            }
//        } else {
//            if (!$this->checkSessionAdmin()) {
//                // quay lại trang login
//                return redirect()->route('admin.login.index');
//            }
//        }

        if(!$this->checkSessionAdmin($request)){
            return redirect()->route('admin.login.index');
        }

        return $next($request);
    }

    // kiểm tra session admin có tồn tại hay không?
    private function checkSessionAdmin($request)
    {
//        $id_username = session('id_username');
//        $username = session('username');
//        if (is_numeric($id_username) && !empty($username)) {
//            return true;
//        }
//        return false;

        $session_id = $request->session()->get('id_username');
        return is_numeric($session_id) && $session_id > 0 ? true : false;
    }
}
