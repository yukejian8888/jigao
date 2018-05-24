<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleCreateRequest extends FormRequest
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
             'role_name'=>'required|unique:role',
            // 'role_level'=>'required'
         ];
     }
     public function messages()
     {
         return [
             'role_name.required'=>'角色名不能为空',
             'role_name.unique'=>'角色名已存在'
            // 'role_level.required'=>'请填写角色等级'
         ];
     }
}
