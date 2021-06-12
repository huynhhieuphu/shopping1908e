<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBrandPost extends FormRequest
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
            'nameBrand' => 'required|max:100|unique:brands,name',
            'decrBrand' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nameBrand.required' => 'Tên Thuơng Hiệu không được để trống',
            'nameBrand.max' => 'Tên Thuơng Hiệu tối đa :max ký tự',
            'nameBrand.unique' => 'Tên Thuơng Hiệu này đã tồn tại',
            'decrBrand.required' => 'Mô tả Thuơng Hiệu không được để trống'
        ];
    }
}
