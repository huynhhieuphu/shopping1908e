<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use voku\helper\AntiXSS;

class TestController extends Controller
{
    // hàm __construct là hàm chạy đầu tiên. khi viết middleware nằm trong đó sẽ chạy...
    public function __construct()
    {
        /*
         * Trong trường hợp này không sử dụng middleware router mà sử dụng middleware controller
         *
         * Vì khi sử dụng middleware router nó hầu hết sẽ tác động lên toàn bộ phương thức trong controller đó.
         * Vậy nếu muốn dùng middleware chỉ tác động 1 số phương thức controller thì sao ???
         * thì gọi middleware trong controller.
         * */

        // sẽ gọi middleware ở đây

        // 1/ dùng middleware tác động lên tất cả phương thức trong controller này
        // $this->middleware('check.role.user:normal');

        // 2/ dùng middleware tác động lên các phương thức được chỉ định
//        $this->middleware('check.role.user:normal')->only('index');
//        $this->middleware('check.role.user:normal')->only(['demoMiddleware', 'middlewareOnly']);

        // 3/ dùng middleware loại trừ các phương thức không cần tác động đến
        // $this->middleware('check.role.user:normal')->except('middlewareExcept');
        // $this->middleware('check.role.user:normal')->except(['demoMiddleware', 'middlewareOnly']);
    }

    public function index()
    {
        return "This is " . __METHOD__ . " of class - " . __CLASS__;
    }

    public function demoMiddleware()
    {
        return "This is function: " . __FUNCTION__ . " - of class: " . __CLASS__;
    }

    public function middlewareOnly()
    {
        return "This is function: " . __FUNCTION__ . " - of class: " . __CLASS__;
    }

    public function middlewareExcept()
    {
        return "This is function: " . __FUNCTION__ . " - of class: " . __CLASS__;
    }

    // Tham số truyền từ Route
    public function demoRequest(Request $request)
    {
        // http://127.0.0.1:8001/demo-request/teo/111?age=30&gender=male

        // lấy giá trị từ tham số route truyền qua : http://127.0.0.1:8001/demo-request/teo/111
        $name = $request->name;
        $id = $request->id;

        // lấy giá trị từ tham số trưc tiếp từ URL theo kiểu query string: ?age=30&gender=male
        $age = $request->query('age'); // $request->age
        $gender = $request->query('gender'); // $request->gender

        $queryString = $request->getQueryString();
        return "name: {$name} - id: {$id}, age: {$age} - gender: {$gender}, query: {$queryString}";
    }

    public function demoResponse()
    {
        // response về 1 cái view
        // bản chất nạp vào 1 view - load 1 về 1 view;
        return view('login.login_view');
    }

    public function login(Request $request, AntiXSS $antiXss)
    {
        // hàm dd() tương đương với var_dump(); và die();
        //dd($request->all());
        $username = $request->txtUserName;
        $password = $request->txtPassword;

        // Validation
        //$username = strip_tags($username);

        // sử dụng thư viện Anti-XSS
        $username = $antiXss->xss_clean($username);
        $password = $antiXss->xss_clean($password);

        //dd($username, $password);

        if ($username == 'admin' && $password == '123456') {
//            dd('ok');
            return redirect(route('test.dashboard'));
        } else {
//            dd('fail');
            return redirect(route('test.demo.response',['state' => 'fail']));
        }
    }
}
