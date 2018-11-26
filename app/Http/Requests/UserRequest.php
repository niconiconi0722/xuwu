<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Auth;

class UserRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'username' => 'required|string|max:60|unique:users,username|regex:/^[A-Za-z0-9\-\_]+$/',
                    'ni_cheng' => 'max:60|string|nullable',
                    'password' => 'between:8,20|string|confirmed|required',
                    'email' => [
                        'email',
                        'nullable',
                        Rule::unique('users')->ignore(Auth::id())
                    ]
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'ni_cheng' => 'max:60|string|nullable',
                    'email' => [
                        'email',
                        'nullable',
                        Rule::unique('users')->ignore(Auth::id())
                    ],
                    'password' => 'min:8|string|nullable|confirmed',
                    'img' => [
                        'nullable',
                        'regex:/^data:\s*image\/(jpg|jpeg|gif|png);base64,[A-Za-z0-9+\/]+\={0,2}$/'
                    ],
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'ni_cheng.max' => ' 昵称 不能超过60个字符',
            'username.unique' => ' 用户名 已被占用',
            'username.regex' => '用户名只能由数字、大写字母、小写字母、横杠-、下划线_组成',
            'ni_cheng.max' => ' 昵称 不能超过60个字符',
            'img.regex' => '上传的头像需要被Base64编码'
        ];
    }
}
