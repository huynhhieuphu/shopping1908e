<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginPost;
use voku\helper\AntiXSS;
use App\Model\Admin;


class LoginController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['message'] = $request->session()->get('login_fail');
        // tương đương code: $data['message'] = $_SESSION['login_fail'] ?? ''
        return view('admin.login.index', $data);
    }

    // Thay đối tượng Request thành đối tượng mới tạo từ request (AdminLoginPost)
    // Đối tượng Admin là model
    public function handleLogin(AdminLoginPost $request, AntiXSS $antiXss, Admin $admin)
    {
//        $data = $request->all();
//        dd($data);

        // sử dụng thư viện Anti-xss
        $username = $antiXss->xss_clean($request->input('username'));
        $password = $antiXss->xss_clean($request->input('password'));

        $infoAdmins = $admin->handleLogin($username, $password);

        if ($infoAdmins) {
            // lưu thông tin của user vào session, để tiến cho các công việc xử lý sau này
            $request->session()->put('username', $infoAdmins['username']);
            // tương đương code thuận $_SESSION['username'] = $infoAdmins['username'];
            $request->session()->put('id_username', $infoAdmins['id']);
            $request->session()->put('email', $infoAdmins['email']);
            $request->session()->put('Role', $infoAdmins['Role']);

            //cập nhật column last_login
            $admin->updateLastLogin($infoAdmins['id']);

            //điều hướng sang trang dashboard
            return redirect()->route('admin.dashboard.index');
        } else {
            // tạo ra session flash để thông báo lỗi
            // quay về lại trang login
            $request->session()->flash('login_fail', 'Username hoặc Password không chính xác');
            return redirect()->route('admin.login.index');
        }
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('username')) {
            $request->session()->forget('username');
            $request->session()->forget('id_username');
            $request->session()->forget('email');
            $request->session()->forget('Role');
            // tương dương unset($_SESSION['username']);

            return redirect()->route('admin.login.index');
        }
    }
}
