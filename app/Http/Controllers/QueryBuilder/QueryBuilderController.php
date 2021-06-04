<?php

namespace App\Http\Controllers\QueryBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    public function index()
    {
//        $products = DB::table('products')->get();

//        $products = DB::table('products')
//            ->select('name as Product', 'images as Image', 'price as Price')
//            ->where('brand_id', '2')
//            ->first();

//        $products = DB::table('products')->find(4);
//        dump($products);

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////
//        $count = DB::table('products')->count();
//        $max = DB::table('products')->max('price');
//        $min = DB::table('products')->min('price');
//        $avg = DB::table('products')->where('brand_id', 2)->avg('price');
//        $sum = DB::table('products')->where('brand_id', 2)->sum('price');

//        dd($count, $max, $min, $avg, $sum);

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// SELECT
//        $products = DB::table('products')->select('name','images','price')->get();

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// JOIN
//        $products = DB::table('products as p')
//            ->select('p.name as product', 'p.price as price','c.name as color')
//            ->join('product_color as pc', 'p.id', '=', 'pc.product_id')
//            ->join('colors as c', 'c.id', '=', 'pc.color_id')
//            ->get();
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// WHERE
//        $product1 = DB::table('products')->where('id', 3)->get();
//        //hoặc
//        $product2 = DB::table('products')->where('id', '=',3)->get();
//
//        dd($product1, $product2);

//        $products = DB::table('products')->where('price', '>=', 600000)->get();

//        $products = DB::table('products')->where('quantity', '<>', 15)->get();

//        $product = DB::table('products')->where('name', 'like', '%long%')->get();

        $products = DB::table('products')
            ->where('price', '>=', '700000')
            ->orWhere('brand_id', '3')
            ->get();

        dd($products);
    }
}
