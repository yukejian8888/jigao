<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleSortUpdateRequest extends FormRequest
{
    protected $rules = [
        'name' => ['required', 'unique:permissions,name'],
        'display_name' => ['required'],
        'description' => ['max:100'],
    ];

    protected $messages = [
        'name.unique' => '“权限名称”已存在。',
        'name.required' => '必须填写“权限名称”',
        'display_name.required' => '必须填写“权限显示名称”。',
        'description.max' => '“权限说明”不能大于100个字。',
    ];

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
//        return $this->rules;
        return [
            'name' => 'required',
        ];
    }
//    public function rules()
//    {
//        $id = $this->route('id');
//        $rules = $this->rules;
//        $rules['name'] = ['required', 'unique:permissions,name,'.$id];
//
//        return $rules;
//    }
//
//    public function messages()
//    {
//        return $this->messages;
//    }
}
