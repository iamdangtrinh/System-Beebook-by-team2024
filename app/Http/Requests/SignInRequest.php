<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password1' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email không được để rỗng',
            'email.email' => 'Email không đúng định dạng',
            'password1.required' => 'Mật khẩu không được để rỗng',
        ];
    }
}