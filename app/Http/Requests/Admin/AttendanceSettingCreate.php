<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceSettingCreate extends FormRequest
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
            'rule_name'=>'required'

        ];
    }
    public function messages()
    {
//        return parent::messages(); // TODO: Change the autogenerated stub
        return [
            'rule_name.required'=>'请填写规则名称'
        ];
    }
}
