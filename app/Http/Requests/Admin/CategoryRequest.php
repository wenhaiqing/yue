<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rule =  [
            'name' => 'required',
            'pid' => 'required',
        ];

//        if ($this->pid) {
//            $rule['url'] = 'required';
//        }
        return $rule;
    }

    /**
     * 验证信息
     * @Author   wenhaiqing
     * @DateTime 2017-07-26T22:24:11+0800
     * @return   [type]                   [description]
     */
    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
        ];
    }
    
    /**
     * 字段名称
     * @Author   wenhaiqing
     * @DateTime 2017-07-26T22:24:19+0800
     * @return   [type]                   [description]
     */
    public function attributes()
    {
        return [
            'name'  => trans('category.name'),
            'pid'  => trans('category.pid'),

        ];
    }
}
