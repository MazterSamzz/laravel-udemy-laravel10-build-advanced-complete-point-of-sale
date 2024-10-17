<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
     * Prepare the data for validation.
     *
     * Remove commas from the price fields and convert them to integers.
     */
    protected function prepareForValidation()
    {

        $this->merge([
            'code' => $this->input('code') ?: IdGenerator::generate([
                'table' => 'products',
                'field' => 'code',
                'length' => 6,
                'prefix' => 'PC'
            ])
        ]);

        if ($this->has('buying_price'))
            $buying_price = str_replace(',', '', $this->input('buying_price')); // Menghapus koma

        if ($this->has('selling_price'))
            $selling_price = str_replace(',', '', $this->input('selling_price')); // Menghapus koma

        $this->merge([
            'buying_price' => intval($buying_price),
            'selling_price' => intval($selling_price),
        ]);
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
            'code' => ['required', 'string'],
            'garage' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'store' => ['nullable'],
            'buying_date' => ['nullable', 'string'],
            'expire_date' => ['nullable', 'string'],
            'buying_price' => ['nullable', 'numeric'],
            'selling_price' => ['nullable', 'numeric'],
        ];
    }
}
