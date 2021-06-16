<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Khai báo model tương ứng table trong database
    protected $table = 'categories';

    // Định nghĩa mối quan hệ bảng khác bằng phương thức
    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
