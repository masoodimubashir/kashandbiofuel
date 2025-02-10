<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'digits:10'],
            'state' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'pin_code' => ['required', 'string', 'max:10', 'min:1'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
