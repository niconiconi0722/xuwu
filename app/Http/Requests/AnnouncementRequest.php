<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:60',
            'content' => 'required|string|max:5000',
            'priority' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请输入标题',
            'title.max' => '标题不能超过60个字',
            'content.required' => '请输入内容',
            'content.max' => '内容不能超过5000个字',
            'priority.integer' => '优先级错误',
        ];
    }
}
