<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductPost extends FormRequest
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
            'nameProd' => 'required|max:255',
            'priceProd' => 'required',
            'quantityProd' => 'required|numeric',
            'brandProd' => 'required|numeric',
            'categoryProd' => 'required|numeric',
            'sizeProd' => 'required',
            'colorProd' => 'required',
            'tagProd' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nameProd.required' => 'Tên sản phẩm không để trống',
            'nameProd.max' => 'Tên sản phẩm tối đa :max',
            'priceProd.required' => 'Giá sản phẩm không để trống',
            'quantityProd.required' => 'Số lượng không để trống',
            'quantityProd.numeric' => 'Số lượng phải là số',
            'brandProd.required' => 'Thương hiệu không để trống',
            'brandProd.numeric' => 'Thương hiệu phải là số',
            'categoryProd.required' => 'Danh mục không để trống',
            'categoryProd.numeric' => 'Danh mục phải là số',
            'sizeProd.required' => 'Kích cỡ không để trống',
            'colorProd.required' => 'Màu sắc không để trống',
            'tagProd.required' => 'Thẻ không để trống',
        ];
    }
}
