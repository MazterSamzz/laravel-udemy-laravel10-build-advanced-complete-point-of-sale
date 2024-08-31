<?php

namespace App\Http\Requests\Product;

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
            'name' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'code' => ['nullable', 'string'],
            'garage' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'store' => ['nullable', 'string'],
            'buying_date' => ['nullable', 'string'],
            'expire_date' => ['nullable', 'string'],
        ];
    }
}
