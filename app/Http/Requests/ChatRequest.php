<?php

namespace App\Http\Requests;

class ChatRequest extends Request
{
    public function rules()
    {
        return [
            'content' => 'required|max:150',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
