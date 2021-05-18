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


// Middleware - Route
Route::get('xem-phim/{nameFilm}/{age}', function ($nameFilm, $age) {
    return "Bạn đang xem phim : {$nameFilm} - độ tuổi cho phép : {$age} ";
})->name('xemphim')->middleware('check.age'); // sử dụng middleware

Route::get('khong-duoc-xem', function () {
    return 'Ban chua du tuoi xem phim';
})->name('khongduocxem');


Route::get('/check-number/{number}', function($number){
    // hàm redirect() : điều hướng sang đường dẫn khác
    return redirect(\route('sochan',['number' => $number]));
})->middleware('check.number');

route::get('/so-chan/{number}', function ($number){
    return "Bạn vừa kiểm tra số chẵn {$number}";
})->name('sochan');

route::get('/so-le/{number}', function ($number){
    return "Bạn vừa kiểm tra số lẻ {$number}";
})->name('sole');
