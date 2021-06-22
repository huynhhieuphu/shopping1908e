<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use App\Model\Size;
use App\Model\Tag;
use App\Http\Requests\AdminProductPost as ProductRequest;
use voku\helper\AntiXSS;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $message = $request->session()->get('message');
        return view('admin.product.index', compact('message'));
    }

    public function add(Request $request)
    {
        $brands = Brand::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();
        //dd($colors, $sizes, $tags);
        $message = $request->session()->get('message');
        return view('admin.product.add', compact(
            'brands',
            'categories',
            'colors',
            'sizes',
            'tags',
            'message'
        ));
    }

    public function handleAdd(ProductRequest $request, AntiXSS $antiXSS)
    {
        $nameProduct = $request->nameProd;
        $nameProduct = $antiXSS->xss_clean($nameProduct);
        $slugProduct = Str::slug($nameProduct);
        $priceProduct = $request->priceProd;
        $priceProduct = trim(str_replace(',', '', $priceProduct));
        $qtyProduct = $request->quantityProd;
        $qtyProduct = is_numeric($qtyProduct) && $qtyProduct > 0 ? $qtyProduct : 1;
        $saleProduct = $request->saleOff;
        $saleProduct = is_numeric($saleProduct) ? $saleProduct : 0;
        $codeProduct = $request->code;
        $codeProduct = $antiXSS->xss_clean($codeProduct);
        $brandProduct = $request->brandProd;
        $cateProduct = $request->categoryProd;
        $sizeProduct = $request->sizeProd;
        $colorProduct = $request->colorProd;
        $tagProduct = $request->tagProd;
        $sttProduct = $request->statusProd;
        $sttProduct = $qtyProduct == 0 || $sttProduct == 1 ? $qtyProduct : 0;

        // Upload file
        $arrImageProduct = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                // 1. lấy ra tên file
                $nameFile = $file->getClientOriginalName();
                // 2. upload lên server
                $file->move('admin/upload/images', $nameFile);
                $arrImageProduct[] = $nameFile;
            }
        }

        if ($arrImageProduct) {
            $strImageProduct = json_encode($arrImageProduct);
            // insert vào bảng cha
            $product = Product::create([
                'name' => $nameProduct,
                'slug' => $slugProduct,
                'images' => $strImageProduct,
                'quantity' => $qtyProduct,
                'price' => $priceProduct,
                'category_id' => $cateProduct,
                'brand_id' => $brandProduct,
                'sale_off' => $saleProduct,
                'code' => $codeProduct,
                'status' => $sttProduct,
                'count_view' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            // Tiếp theo: lấy id bảng cha insert vào các bảng quan hệ n-n
            $idProduct = $product->id;

            // insert vao bang product => lay ra duoc Id vua insert vao db
            // insert vao bang product_color
            // insert vao bang product_size
            // insert vao bang product_tag
            if (is_numeric($idProduct) && $idProduct > 0) {
                foreach ($sizeProduct as $idSize) {
                    DB::table('product_size')->insert([
                        'product_id' => $idProduct,
                        'size_id' => $idSize,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                foreach ($colorProduct as $idColor) {
                    DB::table('product_color')->insert([
                        'product_id' => $idProduct,
                        'color_id' => $idColor,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                foreach ($tagProduct as $idTag) {
                    DB::table('product_tag')->insert([
                        'product_id' => $idProduct,
                        'tag_id' => $idTag,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                $request->session()->flash('message',
                    '<div class=\'alert alert-success\'>Thêm sản phẩm thành công</div>');
                return redirect()->route('admin.product.add');
            } else {
                $request->session()->flash('message', '<div class=\'alert alert-danger\'>Thêm sản phẩm thất bại</div>');
                return redirect()->route('admin.product.add');
            }
        } else {
            $request->session()->flash('message', '<div class=\'alert alert-danger\'>Lỗi tải ảnh</div>');
            return redirect()->route('admin.product.add');
        }
    }
}
