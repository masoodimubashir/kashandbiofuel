<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'product_attribute_id' => 'nullable|exists:product_attributes,id',
            'user_id' => 'nullable|exists:users,id',
            'guest_id' => 'nullable|string',
            'coupon_code' => 'sometimes|string',
        ];
    }


    public function messages(): array{

        return [
            'product_attribute_id.exists' => 'Oops! Seems Like You didnt select the color',
        ];

    }

    public function authorize(): bool
    {
        return true;
    }
}
