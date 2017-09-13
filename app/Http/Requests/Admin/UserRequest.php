<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
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
        $rules['name'] = 'required';
        // 添加用户
        if (request()->isMethod('POST')) {
            $rules['password'] = 'required';
            $rules['username'] = 'required|unique:users,username';
        }else{
            // 修改时 request()->method() 方法返回的是 PUT或PATCH
            $rules['username'] = [
                'required',
                Rule::unique('users')->ignore(decodeId(request()->route('user'), 'user')),
            ];
        }
        return $rules;
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
            'unique'    => trans('validation.unique'),
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
            'name'  => trans('user.name'),
            'username'  => trans('user.username'),
            'password'  => trans('user.password'),
        ];
    }
}
