<?php

namespace App\Http\Requests;

use Auth;

class ArticleRequest extends Request
{
    public function rules()
    {
        switch ($this->method) {
            case 'POST':
                return [
                    'title' => 'required|string|max:60',
                    'content' => 'required|string|max:5000',
                ];
                break;

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'title.required' => '请输入标题',
            'title.max' => '标题不能超过60个字',
            'content.required' => '请输入内容',
            'content.max' => '内容不能超过5000个字',
        ];
    }
}
