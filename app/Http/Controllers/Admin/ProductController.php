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
use App\Http\Requests\AdminUpdateProductPost as UpdateProductRequest;
use voku\helper\AntiXSS;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    const LIMITED_ROW = 3;

    public function index(Request $request)
    {
        $products = Product::paginate(self::LIMITED_ROW);
        return view('admin.product.index', compact('products'));
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
        $sttProduct = $qtyProduct == 0 || $sttProduct == 1 ? $sttProduct : 0;

        // Upload file
        $arrImageProduct = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                // 1. lấy ra tên file
                $nameFile = time() . '-' . $file->getClientOriginalName();
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

    public function edit(Request $request)
    {
        $idProduct = $request->id;
        $idProduct = is_numeric($idProduct) && $idProduct > 0 ? $idProduct : 0;

        $message = $request->session()->get('message');

        if ($idProduct) {
            $product = DB::table('products')
                ->where('id', $idProduct)
                ->first();

            $brands = Brand::where('status', 1)->get();
            $categories = Category::where('status', 1)->get();
            $colors = Color::where('status', 1)->get();
            $sizes = Size::where('status', 1)->get();
            $tags = Tag::where('status', 1)->get();

            $selectedSizes = DB::table('product_size')
                ->where('product_id', $product->id)
                ->where('isHidden', 1)
                ->get();

            $selectedColors = DB::table('product_color')
                ->where('product_id', $product->id)
                ->where('isHidden', 1)
                ->get();

            $selectedTags = DB::table('product_tag')
                ->where('product_id', $product->id)
                ->where('isHidden', 1)
                ->get();

            return view('admin.product.edit', compact(
                'product',
                'brands', 'categories',
                'colors', 'sizes', 'tags',
                'selectedSizes', 'selectedColors', 'selectedTags',
                'message'
            ));
        }
    }

    public function update(UpdateProductRequest $request, AntiXSS $antiXSS)
    {
//        dd($request->all());

        $idProd = $request->idProd;
        $idProd = is_numeric($idProd) && $idProd > 0 ? $idProd : 0;

        if ($idProd > 0) {
            $product = DB::table('products')
                ->where('id', $idProd)
                ->first();
            $oldSlug = $product->slug;
            $oldImages = $product->images;
            $oldImages = json_decode($oldImages);
        } else {
            return abort(404);
        }

        if (array_key_exists('newImages', $request->all()) || array_key_exists('oldImages', $request->all())) {
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
            $sttProduct = $qtyProduct == 0 || $sttProduct == 1 ? $sttProduct : 0;

            $currentImages = $request->oldImages;
            // Xoá hình
            if (!empty($currentImages)) {
                // xoá các hình ảnh đã bỏ
                $images = array_diff($oldImages, $currentImages);
                if ($images) {
                    foreach ($images as $item) {
                        $image_path = public_path('admin/upload/images/' . $item);
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                    }
                }
            } else {
                // xoá tất cả hình cũ
                foreach ($oldImages as $item) {
                    $image_path = public_path('admin/upload/images/' . $item);
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
            }

            // Upload file new
            if ($request->hasFile('newImages')) {
                $files = $request->file('newImages');
                foreach ($files as $file) {
                    // 1. lấy ra tên file
                    $nameFile = time() . '-' . $file->getClientOriginalName();
                    // 2. upload lên server
                    $file->move('admin/upload/images', $nameFile);
                    $currentImages[] = $nameFile;
                }
            }

            if ($currentImages) {
                $strImageProduct = json_encode($currentImages);
                $update = DB::table('products')
                    ->where('id', $idProd)
                    ->update([
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
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                if ($update) {
                    $updateSize = $this->updateSizeProduct($idProd, $sizeProduct);
                    $updateColor = $this->updateColorProduct($idProd, $colorProduct);
                    $updateTag = $this->updateTagProduct($idProd, $tagProduct);
//
//                foreach ($colorProduct as $idColor) {
//                    DB::table('product_color')
//                        ->where('id', $idProd)
//                        ->update([
//                        'product_id' => $idProd,
//                        'color_id' => $idColor,
//                        'updated_at' => date('Y-m-d H:i:s')
//                    ]);
//                }
//
//                foreach ($tagProduct as $idTag) {
//                    DB::table('product_tag')
//                        ->where('id', $idProd)
//                        ->update([
//                        'product_id' => $idProd,
//                        'tag_id' => $idTag,
//                        'updated_at' => date('Y-m-d H:i:s')
//                    ]);
//                }
                    $request->session()->flash('message',
                        '<div class=\'alert alert-success\'>Cập nhật sản phẩm thành công</div>');
                    return redirect()->route('admin.product.edit', ['id' => $idProd, 'slug' => $slugProduct]);
                } else {
                    $request->session()->flash('message',
                        '<div class=\'alert alert-danger\'>Cập nhật sản phẩm thất bại</div>');
                    return redirect()->route('admin.product.edit', ['id' => $idProd, 'slug' => $oldSlug]);
                }
            } else {
                $request->session()->flash('message', '<div class=\'alert alert-danger\'>Lỗi tải ảnh</div>');
                return redirect()->route('admin.product.edit', ['id' => $idProd, 'slug' => $oldSlug]);
            }
        } else {
            $request->session()->flash('message',
                '<div class=\'alert alert-danger\'><strong> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Cảnh báo: </strong>Hình ảnh không được để trống</div>');
            return redirect()->route('admin.product.edit', ['id' => $idProd, 'slug' => $oldSlug]);
        }
    }

    private function updateSizeProduct($idProduct, $sizes)
    {
        // reset về 0
        $isHidden = DB::table('product_size')
            ->where('product_id', $idProduct)
            ->update([
                'isHidden' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        if ($isHidden) {
            // Kiểm tra ID product và ID size có tồn tại hay không
            foreach ($sizes as $size) {
                $size_exists = DB::table('product_size')
                    ->where('product_id', $idProduct)
                    ->where('size_id', $size)
                    ->first();
                if ($size_exists) {
                    // Tồn tại thì update
                    try {
                        DB::table('product_size')
                            ->where('product_id', $idProduct)
                            ->where('size_id', $size)
                            ->update([
                                'isHidden' => 1,
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    } catch (\Exception $e) {
                        return  'Update Error: ' . $e->getMessage();
                    }
                } else {
                    // Ngược lại thì insert
                    try {
                        DB::table('product_size')->insert([
                            'product_id' => $idProduct,
                            'size_id' => $size,
                            'isHidden' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    } catch (\Exception $e) {
                        return  'Update Error: ' . $e->getMessage();
                    }
                }
            }
            return true;
        }
        return false;
    }

    private function updateColorProduct($idProduct, $colors)
    {
        // reset về 0
        $isHidden = DB::table('product_color')
            ->where('product_id', $idProduct)
            ->update([
                'isHidden' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        if ($isHidden) {
            // Kiểm tra ID product và ID size có tồn tại hay không
            foreach ($colors as $color) {
                $size_exists = DB::table('product_color')
                    ->where('product_id', $idProduct)
                    ->where('color_id', $color)
                    ->first();
                if ($size_exists) {
                    // Tồn tại thì update
                    try {
                        DB::table('product_color')
                            ->where('product_id', $idProduct)
                            ->where('color_id', $color)
                            ->update([
                                'isHidden' => 1,
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    } catch (\Exception $e) {
                        return  'Update Error: ' . $e->getMessage();
                    }
                } else {
                    // Ngược lại thì insert
                    try {
                        DB::table('product_color')->insert([
                            'product_id' => $idProduct,
                            'color_id' => $color,
                            'isHidden' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    } catch (\Exception $e) {
                        return  'Update Error: ' . $e->getMessage();
                    }
                }
            }
            return true;
        }
        return false;
    }

    private function updateTagProduct($idProduct, $tags)
    {
        // reset về 0
        $isHidden = DB::table('product_tag')
            ->where('product_id', $idProduct)
            ->update([
                'isHidden' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        if ($isHidden) {
            // Kiểm tra ID product và ID size có tồn tại hay không
            foreach ($tags as $tag) {
                $size_exists = DB::table('product_tag')
                    ->where('product_id', $idProduct)
                    ->where('tag_id', $tag)
                    ->first();
                if ($size_exists) {
                    // Tồn tại thì update
                    try {
                        DB::table('product_tag')
                            ->where('product_id', $idProduct)
                            ->where('tag_id', $tag)
                            ->update([
                                'isHidden' => 1,
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    } catch (\Exception $e) {
                        return  'Update Error: ' . $e->getMessage();
                    }
                } else {
                    // Ngược lại thì insert
                    try {
                        DB::table('product_tag')->insert([
                            'product_id' => $idProduct,
                            'tag_id' => $tag,
                            'isHidden' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    } catch (\Exception $e) {
                        return  'Update Error: ' . $e->getMessage();
                    }
                }
            }
            return true;
        }
        return false;
    }
}
