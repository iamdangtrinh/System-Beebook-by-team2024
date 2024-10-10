<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8', // Ít nhất 8 ký tự
                'regex:/[0-9]/', // Chứa ít nhất 1 chữ số
                'regex:/[@$!%*#?&]/', // Chứa ít nhất 1 ký tự đặc biệt
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            // Validation email
            'email.required' => 'Vui lòng nhập email của bạn',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            
            // Validation password
            'password.required' => 'Vui lòng nhập mật khẩu của bạn',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ số và 1 ký tự đặc biệt',
        ];
    }
}
