<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'unique:suppliers,name'],
            'email' => ['required', 'unique:suppliers,email'],
            'phone' => ['required', 'unique:suppliers,phone'],
            'address' => ['required', 'string'],
            'shopname' => ['required', 'string'],
            'type' => ['required', 'string'],
            'photo' => ['nullable', 'image'],
            'bank_name' => ['nullable', 'string'],
            'account_holder' => ['nullable', 'string'],
            'account_number' => ['nullable', 'string'],
            'bank_branch' => ['nullable', 'string'],
            'city' => ['nullable', 'string']
        ];

        return $rules;
    }
}
