<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'phone.required' => 'Vui lòng nhập số điện thoại nhận hàng',
            'phone.integer' => 'Số điện thoại không đúng định dạng',
            'province.required' => 'Vui lòng nhập thành phố/ tỉnh',
            'district.required' => 'Vui lòng nhập quận/huyện',
            'ward.required' => 'Vui lòng nhập xã/phường',
            'address.required' => 'Vui lòng nhập địa chỉ giao hàng',
        ];
    }
}
