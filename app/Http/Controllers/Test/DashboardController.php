<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['lstUser'] = [
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@test.com', 'gender' => 1],
            ['id' => 2, 'username' => '<b>manager</b>', 'email' => 'manager@test.com', 'gender' => 0],
            ['id' => 3, 'username' => '<h2>enduser</h2>', 'email' => 'enduser@test.com', 'gender' => 1]
        ];
        $data['fullname'] = 'Tony Teo';
        $data['role'] = 'admin';

        // truyền dữ liệu ra ngoài view
        return view('test.dashboard.index_view', $data);
    }
}
