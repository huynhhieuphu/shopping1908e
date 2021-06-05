<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// chạy phương thức $_GET
// trong hàm get có 2 tham số $uri và $callback
// $uri gọi là request - gửi lên
// $callback gọi là response - trả về

Route::get('/', function () {
    return view('welcome');
//    return "Welcome Laravel";
});

Route::get('/hello-world', function () {
    return "Hello Wolrd !!!";
});

// Ngoại tự trừ phương thức get, các phương thức còn lại cần phải có Csrf Token

// chạy phương thức $_POST
Route::post('/api/demo-post', function () {
    return "This is method post";
});

Route::post('/api/create-user', function () {
    return "This is method create user";
});

// chạy nhiều phương thức theo mình chỉ định
Route::match(['get', 'post'], '/get-or-post', function () {
    return "Chay nhieu phuong thuc khac nhau";
});

// chạy bất kỳ phương thức
Route::any('/access-any-method', function () {
    return "Access any method...";
});

// truyền tham số bắt buộc lên router
Route::get('/product/{name}/{id}', function ($nameProduct, $idProducts) {
    return "Sản phẩm tên: {$nameProduct} - mã sp: {$idProducts}";
    // {name}, {id} là tham số bắt buộc truyền lên trên url
});

// truyền tham số không bắt buộc router
Route::get('/watch-film/{name?}', function ($nameFilm = null) {
    return "Bạn đang xem phim gì: {$nameFilm}";
    // {name?} là tham số không bắt buộc (có dấu chấm hỏi) - tuỳ chọn truyền hay không truyền trên url
});

// quy đình logic tham số
Route::get('/customer/edit/{id}', function ($idCustromer) {
    return "mã khách hàng phải là số: {$idCustromer}";
})->where('id', '\d+');

Route::get('/post/{name}/{id}', function ($namePost, $idPost) {
    return "mã bài viết phải là chữ: {$namePost} - mã bài viết là số: {$idPost}";
})->where(['name' => '[A-Za-z]+', 'id' => '\d+']);
/*
 * Dùng biểu thức chính quy:
 * trong chuỗi '\w+' là cho phép chữ viết hoa, viết thường và số.
 * */

// name router
Route::get('/profile-detail/{id}', function ($idProfile) {
    return "Hồ sơ id: {$idProfile}";
})->where('id', '\d+')->name('profile.detail');

// group router
Route::group([
    'prefix' => 'Admin', // prefix
    'as' => 'admin.' // as định nghĩa như name, tiền tố của router
], function () {
    Route::get('/category', function () { // path: '/Admin/category'
        return "Admin - category";
    })->name('category'); // => không cần gõ name('admin.category')
    Route::get('/product', function () { // path: '/Admin/product'
        return "Admin - product";
    })->name('product'); // => không cần gõ name('admin.product')
});

// router mặc định khi truy cập router không tồn tại
Route::fallback(function () {
    //abort(); // Hiển thị trang 404
    return "Khong tim thay yeu cau";
});

// Router view: router trỏ thảng vào 1 view - trực tiếp gọi thẳng vào 1 view
Route::view('/router-view', 'router-view', ['name' => 'Tony Teo']);
/*
 * $uri : đường dẫn trên router
 * $view : tên file view, có hậu tố .blade (template laravel)
 * $data: dữ liệu truyền vào view
 * */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Middleware - Route
Route::get('xem-phim/{nameFilm}/{age}', function ($nameFilm, $age) {
    return "Bạn đang xem phim : {$nameFilm} - độ tuổi cho phép : {$age} ";
})->name('xemphim')->middleware('check.age'); // sử dụng middleware

Route::get('khong-duoc-xem', function () {
    return 'Ban chua du tuoi xem phim';
})->name('khongduocxem');

// tiếp tục ví dụ dùng middleware router

Route::get('/check-number/{number}', function($number){
    /*
     * Lưu ý: sau khi xử before middleware xong.
     *
     * Chưa return liền - mà sẽ quay lại middleware (Vị trí này là after middleware)
     * kiểm tra request lại 1 lần nữa có được phép thực thi hay không ?
     *
     * Thực tế ít khi sử dụng after middleware.
     * */
    return redirect(\route('sochan',['number' => $number]));
    // hàm redirect() : điều hướng sang đường dẫn khác
})->middleware('check.number');

route::get('/so-chan/{number}', function ($number){
    return "Bạn vừa kiểm tra số chẵn {$number}";
})->name('sochan');

route::get('/so-le/{number}', function ($number){
    return "Bạn vừa kiểm tra số lẻ {$number}";
})->name('sole');

// Truyền tham số vào middleware
Route::get('/admin/dashboard', function(){
    // Yều cầu phải quyền admin mới cho phép xem nội dung
    return "Bạn được phép xem nội dung này";
})->middleware('check.role.user:admin');
/*
 * Giải thích: ->middleware('check.role.user:admin');
 *    check.role.user -> tên đăng ký middleware
 *    :admin -> tham số truyền vào middleware
 * */

Route::get('/not-access', function(){
   return "Bạn không có quyền truy cập";
})->name('permit');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Router - Controller

/*
 * $action: lúc này là tên-Controller@tên-Function
 * */
Route::get('/test-controller', 'TestController@index')->name('test.index');

// Middleware - Controller
Route::get('/test-demoMiddleware', 'TestController@demoMiddleware')->name('test.demo.middleware');
Route::get('/test-middlewareOnly', 'TestController@middlewareOnly')->name('test.middleware.only');
Route::get('/test-middlewareExcept', 'TestController@middlewareExcept')->name('test.middleware.except');

// Request
Route::get('/demo-request/{name}/{id}', 'TestController@demoRequest')->name('test.demo.request');

// Response
//
Route::get('/demo-response', 'TestController@demoResponse')->name('test.demo.response');
Route::post('/test-login', 'TestController@login')->name('test.login');

// *** TEST ADMIN GROUP ***
Route::group([
    'prefix' => '/test/admin', // dùng để chỉ request: /test/admin/dashboard
    'as' => 'test.', // dùng để chỉ name : test.dashboard
    'namespace' => 'Test' // dùng để chỉ response: Test/DashboardController@index
], function (){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/contact', 'ContactController@index')->name('contact');
});

// QUERY BUILDER
Route::group([
    'prefix' => '/query-builder',
    'namespace' => 'QueryBuilder',
    'as' => 'query.'
], function(){
    Route::get('/test', 'QueryBuilderController@index')->name('index');
});

// ELOQUENT ORM
Route::group([
    'prefix' => '/orm',
    'as' => 'orm.',
    'namespace' => 'Orm'
], function(){
    route::get('/', 'TestController@index')->name('index');
});

