<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name'=>'unique:users,name',//用户名是唯一的，但不是必须的，后期可以完善
            'email'=>'unique:users,email',
            'phone'=>'required|unique:users,phone',
            'password'=>'required|min:6',
            'level_id'=>'not_in:0',
        ];
    }
    public function messages()
    {
        return [
//            'name.required'=>'用户名 不能为空',
            'name.unique'=>'用户名 已存在',
//            'email.required'=>'邮箱 不能为空',
            'email.unique'=>'邮箱 已存在',
            'phone.required'=>'电话 不能为空',
            'phone.unique'=>'电话 已存在',
            'password.required'=>'密码 不能为空',
            'level_id.not_in'=>'请选择会员等级'
        ];
    }
}
