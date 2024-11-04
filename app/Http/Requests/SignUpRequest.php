<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'name' => 'required',
            'phone' => [
                'required',
                'regex:/^0[1-9]{1}[0-9]{8}$/',
                'unique:users,phone',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password1' => [
                'required',
                'min:8',
            ],
            'password_confirm' => [
                'required',
                'min:8',
                'same:password1',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được để rỗng',
            'phone.required' => 'Số điện thoại không được để rỗng',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Email không được để rỗng',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password1.required' => 'Mật khẩu không được để rỗng',
            'password1.min' => 'Mật khẩu chứa ít nhất 8 ký tự',
            'password_confirm.required' => 'Xác nhận mật khẩu không được để rỗng',
            'password_confirm.min' => 'Xác nhận mật khẩu chứa ít nhất 8 ký tự',
            'password_confirm.same' => 'Xác nhận mật khẩu và mật khẩu không trùng nhau',
        ];
    }
}