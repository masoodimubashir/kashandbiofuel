<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'bail|required|string|min:5|max:50',
            'sku' => 'bail|required|string|unique:products,sku',
            'price' => ['bail', 'required', 'numeric', 'decimal:0,2', 'min:0', 'max:99999999.99'],
            'selling_price' => ['bail', 'required', 'numeric', 'decimal:0,2', 'min:0', 'max:99999999.99'],
            'short_description' => 'bail|required|string|min:10|max:255',
            'additional_description' => 'bail|required|string|min:10|max:255',
            'description' => 'bail|required|string|min:10|max:255',
            'category_id' => 'bail|required|exists:categories,id',
            'sub_category_id' => 'bail|required|exists:sub_categories,id',
            'attributes' => 'bail|required|array|min:1',
            'attributes.*.hex_code' => 'bail|required|string|max:7',
            'attributes.*.images.*' => 'bail|required|mimes:jpeg,png,jpg,webp|max:2048',
            'attributes.*.qty' => 'bail|required|integer|min:0',
            'crafted_date' => 'bail|required|date',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Product name is required',
        'name.min' => 'Product name must be at least 5 characters',
        'name.max' => 'Product name cannot exceed 50 characters',
        
        'sku.required' => 'SKU is required',
        'sku.unique' => 'This SKU is already in use',
        
        'price.required' => 'Price is required',
        'price.numeric' => 'Price must be a number',
        'price.decimal' => 'Price must have 2 decimal places',
        
        'selling_price.required' => 'Selling price is required',
        'selling_price.numeric' => 'Selling price must be a number',
        
        'category_id.required' => 'Please select a category',
        'sub_category_id.required' => 'Please select a subcategory',
        
        'attributes.required' => 'At least one product attribute is required',
        'attributes.*.hex_code.required' => 'Color is required for all attributes',
        'attributes.*.qty.required' => 'Quantity is required for all attributes',
        'attributes.*.qty.min' => 'Quantity must be 0 or greater',
        'attributes.*.images.*.required' => 'Images are required for all attributes',
        'attributes.*.images.*.mimes' => 'Images must be jpeg, png, jpg or webp format',
        'attributes.*.images.*.max' => 'Images must not exceed 2MB'
    ];
}

}
