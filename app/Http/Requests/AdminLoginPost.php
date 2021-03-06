<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // bật chức năng
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // thiết lập quy tắc
        return [
            'username' => 'required|max:100',
            'password' => 'required|max:100'
        ];
    }

    public function messages()
    {
        // thông báo khi lỗi
        return [
            'username.required' => 'Username không được trống',
            'username.max' => 'Username tối đa :max ký tự',
            'password.required' => 'Password không được trống',
            'password.max' => 'Password tối đa :max ký tự'
        ];
    }
}
