<?php

namespace App\Http\Controllers\Orm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Đầu tiên: use các model
use App\Model\Category;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Size;
use App\Model\Tag;

class TestController extends Controller
{
    public function index(tag $tag)
    {
        //***** One - Many *****
//        $data = Category::find(1)->Products;

        // Products là phương thức định nghĩa mối quan hệ bảng trong model Category

        // Code trên tương tự câu truy vấn inner join
        // SELECT * FROM `products` AS `p`
        // INNER JOIN `categories` as `c` ON `c`.`id` = `p`.`category_id`
        // WHERE `c`.`id` = 1;

//        $data = Product::find(2)->category;

//        $data = Brand::find(2)->products()->select('name','price')->get();

//        $data = Brand::find(2)->products()->where('price', '>', 300000)->get();


        //***** Many - Many *****

//        $data = Color::find(1)->products;
//        $data = Product::find(4)->colors;

//        $data = Product::find(7)->sizes;
//        $data = Size::all();
        $data = Size::find(5)->products;

        $eloquentOrm =  Product::all();
        // tương đương query builder: DB::table('products')->get();
        $eloquentOrm_2 = Product::find(1);
        // tương đương query builder: DB::table('products')->where('id', 1)->get();

        // Nếu tập hợp dữ liệu là Eloquent Models, cần chuyển object về array ta dùng toArray();
        // Còn query builder đã trả về mảng k cần dùng toArray()
//        $data = $data->toArray();
//        dd($data);

        //***** INSERT *****
//        $insert = $tag->insertTag('giay nu', null, null, 'giay danh cho nu', 1);
//        if($insert){
//            echo 'Thanh cong insert';
//        }else{
//            echo 'That bai insert';
//        }

//        //***** UPDATE *****
//        $update = $tag->updateTag(1, 'giay nu');
//        if ($update) {
//            echo 'Thanh cong update';
//        } else {
//            echo 'That bai update';
//        }

        //***** DELETE *****
        $delete = $tag->deleteTag(1);
        if ($delete) {
            echo 'Thanh cong delete';
        } else {
            echo 'That bai delete';
        }
    }
}
