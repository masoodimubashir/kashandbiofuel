<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'cart_data' => 'required|array',
            'cart_data.*.cart_id' => 'required|exists:carts,id',
            'cart_data.*.product_attribute_id' => 'required|exists:product_attributes,id',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:cod,online',
            'address_id' => 'required|exists:addresses,id'
        ];
        
    }
}
