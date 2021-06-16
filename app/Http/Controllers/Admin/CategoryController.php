<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Requests\AdminCategoryPost;
use Illuminate\Support\Str;
use voku\helper\AntiXSS;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('parent_id', 0)
            ->get();
        $message = $request->session()->get('message');
        return view('admin.category.index', compact('categories', 'message'));
    }

    public function handleAdd(AdminCategoryPost $request, AntiXSS $antiXSS)
    {
        $nameCate = $request->nameCate;
        $parentCate = $request->parentCate;

        $nameCate = $antiXSS->xss_clean($nameCate);
        $parentCate = $antiXSS->xss_clean($parentCate);
        $parentCate = ($parentCate == '' || $parentCate < 0) ? 0 : $parentCate;

        $category = new Category;
        $category->name = $nameCate;
        $category->slug = Str::Slug($nameCate);
        $category->parent_id = $parentCate;
        $category->status = 1;
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = null;

        if($category->save()){
            $request->session()->flash('message', 'addSuccess');
        }else{
            $request->session()->flash('message', 'addError');
        }
        
        return redirect()->route('admin.category.index');
    }
}
