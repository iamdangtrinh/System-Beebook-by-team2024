<?php

namespace App\Http\Requests;

use App\Models\Product;
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
            'quantity' => [
                'required',
                'numeric',
                'min:1',
                $this->validateQuantityProduct(),
            ],
        ];
    }

    protected function validateQuantityProduct()
    {
        return function ($attribute, $value, $fail) {
            $product = Product::select(['quantity'])->find($_POST['id_product']);

            if ($product && $value > $product->quantity) {
                $fail('Rất tiếc, bạn chỉ có thể mua tối đa ' . $product->quantity . ' sản phẩm.');
            }
        };
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
