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

// Phần này giới thiệu hướng dẫn dùng route như thế nào ??? (code trong file demoRoute.php)
//require_once 'demoRoute.php';

// Phần này xử lý phía khách

Route::get('/', function (){
    return 'Trang nguoi dung';
});

// Phân ra 1 file riêng để xử lý phía admin
require_once 'admin.php';
