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
            'category_id' => ['required', 'unique:categorys,id'],
            'supplier_id' => ['required', 'unique:suppliers,id'],
            'code' => ['nullable', 'string'],
            'garage' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
            'store' => ['nullable', 'string'],
            'buying_date' => ['nullable', 'string'],
            'expire_date' => ['nullable', 'string'],
        ];
    }
}
