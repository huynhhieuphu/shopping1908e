<?php

namespace App\Http\Controllers\Orm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Đầu tiên: use các model
use App\Model\Category;
use App\Model\Product;
use App\Model\Brand;

class TestController extends Controller
{
    public function index()
    {
//        $data = Category::find(1)->Products;

        // Products là phương thức định nghĩa mối quan hệ bảng trong model Category

        // Code trên tương tự câu truy vấn inner join
        // SELECT * FROM `products` AS `p`
        // INNER JOIN `categories` as `c` ON `c`.`id` = `p`.`category_id`
        // WHERE `c`.`id` = 1;

//        $data = Product::(2)->categories;

//        $data = Brand::find(2)->products()->select('name','price')->get();

        $data = Brand::find(2)->products()->where('price', '>', 300000)->get();

        // Nếu tập hợp dữ liệu là Eloquent Models, cần chuyển object về array ta dùng toArray();
        $data = $data->toArray();
        dd($data);
    }
}
