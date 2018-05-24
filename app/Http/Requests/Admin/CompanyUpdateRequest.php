<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
 //            'name'=>'required',
            // 'email'=>'email',
            // 'phone'=>'numeric',
            // 'password'=>'min:6',

         ];
     }
     public function messages()
     {
         return [
 //            'name.required'=>'用户名 不能为空',
 //            'email.required'=>'邮箱 不能为空',
 //            'phone.required'=>'手机号码 不能为空',

         ];
     }
}
