<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // Khai báo model này làm việc bảng dữ liệu
    protected $table = 'brands';

    // định nghĩa 1 phương thức tạo mối quan hệ với bảng
    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
