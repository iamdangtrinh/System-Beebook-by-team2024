<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cartRequest extends FormRequest
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
            'quantity' => 'required|numeric|min:1', // `min:1` để đảm bảo số lượng không âm
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => 'Vui lòng nhập số lượng sản phẩm.',
            'quantity.numeric' => 'Số lượng sản phẩm phải là số.',
            'quantity.min' => 'Số lượng sản phẩm phải lớn hơn hoặc bằng 1.',
        ];
    }
}
