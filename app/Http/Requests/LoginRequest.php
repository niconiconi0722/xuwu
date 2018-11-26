<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|string|max:60',
            'password' => 'required|string|between:8,20',
            'captcha' => 'required|string|captcha',
        ];
    }

    public function messages()
    {
        return [
            'captcha.captcha' => '验证码错误',
        ];
    }
}
