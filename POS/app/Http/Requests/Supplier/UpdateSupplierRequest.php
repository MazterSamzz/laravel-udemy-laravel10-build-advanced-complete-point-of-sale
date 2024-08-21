<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
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
        $id = $this->route('supplier');

        $rules = [
            'name' => ['required', 'max:100', Rule::unique('suppliers')->ignore($id)],
            'email' => ['required', 'max:100', Rule::unique('suppliers')->ignore($id)],
            'phone' => ['required', 'max:100', Rule::unique('suppliers')->ignore($id), 'regex:/^0[1-9][0-9]{7,12}$/'],
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
