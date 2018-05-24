<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorityCreate extends FormRequest
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
            //
           // 'com_name'=>'unique:company,com_name',//用户名是唯一的，但不是必须的，后期可以完善
           // 'com_telphone'=>'required|unique:company,com_telphone',
        ];
    }
    public function messages()
    {
        return [
          //  'com_name.required'=>'单位名不能为空',
          //  'com_name.unique'=>'单位名已存在',
         //   'com_telphone.unique'=>'联系电话已存在',
          //  'com_telphone.required'=>'联系电话不能为空',

        ];
    }
}
