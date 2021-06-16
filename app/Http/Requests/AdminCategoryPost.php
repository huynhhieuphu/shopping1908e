<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCategoryPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nameCate' => 'required|max:100|unique:categories,name',
            'parentCate' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'nameCate.required' => 'Tên danh mục không để trống',
            'nameCate.max' => 'Tên danh mục tối đa :max ký tự',
            'nameCate.unique' => 'Tên danh mục đã tồn tại',
            'parentCate.required' => 'Danh mục cha không để trống',
            'parentCate.numeric' => 'Danh mục cha không hợp lệ'
        ];
    }
}
