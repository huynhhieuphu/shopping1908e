<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Requests\AdminCategoryPost;
use App\Http\Requests\AdminUpdateCategoryPost;
use Illuminate\Support\Str;
use voku\helper\AntiXSS;

class CategoryController extends Controller
{
    const LIMITED_ROW = 3;

    public function index(Request $request)
    {
        // tạo danh mục cây
        $cateView = Category::where([
            'parent_id' => 0
        ])->paginate(self::LIMITED_ROW);

        // lấy ra danh sách các category
        $categories = Category::where('status', 1)->get();
        $message = $request->session()->get('message');
        return view('admin.category.index', compact('categories', 'message', 'cateView'));
    }

    public function handleAdd(AdminCategoryPost $request, AntiXSS $antiXSS)
    {
        $nameCate = $request->nameCate;
        $parentCate = $request->parentCate;

        $nameCate = $antiXSS->xss_clean($nameCate);
        $parentCate = $antiXSS->xss_clean($parentCate);
        $parentCate = ($parentCate == '' || $parentCate < 0) ? 0 : $parentCate;

//        $category = new Category;
//        $category->name = $nameCate;
//        $category->slug = Str::Slug($nameCate);
//        $category->parent_id = $parentCate;
//        $category->status = 1;
//        $category->created_at = date('Y-m-d H:i:s');
//        $category->updated_at = null;

        $insert = Category::create([
            'name' => $nameCate,
            'slug' => Str::Slug($nameCate),
            'parent_id' => $parentCate,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);

        if ($insert) {
            $request->session()->flash('message', '<div class=\'alert alert-success\'>Add Success</div>');
        } else {
            $request->session()->flash('message', '<div class=\'alert alert-danger\'>Add Fail</div>');
        }

        return redirect()->route('admin.category.index');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $id = is_numeric($id) && $id > 0 ? $id : 0;

        if ($id > 0) {
            $category = Category::find($id);
            $category = $category->toArray();

            $parentCate = Category::where('status', 1)->get();
            $parentCate = $parentCate->toArray();

            $message = $request->session()->get('message');

            // nạp dữ liệu vào trong view edit
            return view('admin.category.edit', ['category' => $category, 'parentCate' => $parentCate, 'message' => $message]);
        }
    }

    public function update(AdminUpdateCategoryPost $request, AntiXSS $antiXSS)
    {
//        dd($request->all());
        $idCate = $request->idCate;
        $infoCate = Category::where('id', $idCate)->first()->toArray();

        if($infoCate){
            $slugOld = $infoCate['slug'];

            $parentOld  = $request->parentOld;
            $nameCate = $request->nameCate;
            $slug = Str::slug($nameCate);
            $parentCurrent = $request->parentCate;
            $statusCate = $request->statusCate;
            $statusCate = $statusCate == 0 || $statusCate == 1 ? $statusCate : 0;
            $updated_at = date('Y-m-d H:s:i');

            $nameCate = $antiXSS->xss_clean($nameCate);

            if($parentOld != $parentCurrent){
                //update parent_id
                $update = Category::where('id', $idCate)
                    ->update([
                        'name' => $nameCate,
                        'slug' => $slug,
                        'parent_id' => $parentCurrent,
                        'status' => $statusCate,
                        'updated_at' => $updated_at
                    ]);
            }else{
                $update = Category::where('id', $idCate)
                    ->update([
                        'name' => $nameCate,
                        'slug' => $slug,
                        'status' => $statusCate,
                        'updated_at' => $updated_at
                    ]);
            }

            if($update){
                $request->session()->flash("message", "<div class='alert alert-success'>Update Success</div>");
                return redirect()->route('admin.category.index');
            }else{
                $request->session()->flash('message', '<div class=\'alert alert-danger\'>Update Fail</div>');
                return redirect()->route('admin.category.edit', ['slug' => $slugOld, 'id' => $idCate]);
            }
        }else{
            $request->session()->flash('message', '<div class=\'alert alert-danger\'>Update Error</div>');
            return redirect()->route('admin.category.index');
        }
    }
}
