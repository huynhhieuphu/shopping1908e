<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
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

        // code này middleware tác động toàn bộ phương thức trong controller
        // $this->middleware('check.role.user:normal');

        // middleware tác động khi chỉ định phương thức
        $this->middleware('check.role.user:normal')->only('index');

        // ngược lại, middleware loại trừ phương thức
        // $this->middleware('check.role.user:normal')->except('demo');
        $this->middleware('check.role.user:normal')->except(['demo', 'demoTwo','demoRequest','demoResponse']);
    }

    public function index()
    {
        return "This is " . __METHOD__ . " of class - " . __CLASS__;
    }

    public function demo()
    {
        return "This is " . __METHOD__ . " of class - " . __CLASS__;
    }

    public function demoTwo()
    {
        return "This is " . __METHOD__ . " of class - " . __CLASS__;
    }

    // Cách lấy tham số Router truyền vào phương thức controller
    public function demoRequest(Request $request)
    {
        // ví du: http://127.0.0.1:8001/test-demoRequest/teo/1?age=18&gender=male
        $name = $request->name;
        $id = $request->id;

        // Cách lấy tham số truyền lên URL theo kiểu query string
        // Cách này chỉ áp dụng truyền trực tiếp trên URL, còn trên là khác - router truyền vào phương thức trong controller
        //$age = $request->age;
        //$gender = $request->gender;

        // Thông thường người ta dùng như sau:
        // ? là queryString
        $age = $request->query('age');
        $gender = $request->query('gender');
        $queryString = $request->getQueryString();

        return "name: {$name} - id: {$id} - age: {$age} - gender: {$gender}. <br>Query: {$queryString}";
    }

    public function demoResponse()
    {
        // response về 1 cái view
        // bản chất nạp vào 1 view - load 1 về 1 view;
        return view('login.login_view');
    }
}
