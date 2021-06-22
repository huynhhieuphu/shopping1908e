<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Khai báo model tương ứng table trong database
    protected $table = 'categories';

    // keyword: Mass Assignment
    // khi sử dụng hàm create để tạo mới, cần xác định các thuộc tính truyền
    public $fillable = ['name','slug','parent_id','status','created_at','updated_at'];

    // Định nghĩa mối quan hệ bảng khác bằng phương thức
    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }

    // tạo mối quan hệ trong chính bản category dựa trên cột parent_id
    public function childs()
    {
        return $this->hasMany('App\Model\Category','parent_id', 'id');
    }
}
