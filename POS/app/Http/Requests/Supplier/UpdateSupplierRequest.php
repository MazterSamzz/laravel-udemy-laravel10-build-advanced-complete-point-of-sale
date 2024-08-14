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
            'phone' => ['required', 'max:100', Rule::unique('suppliers')->ignore($id)],
            'address' => ['required'],
            'shopname' => ['required'],
            'type' => ['required'],
            'photo' => ['nullable'],
            'bank_name' => ['nullable'],
            'account_holder' => ['nullable'],
            'account_number' => ['nullable'],
            'bank_branch' => ['nullable'],
            'city' => ['nullable']
        ];

        return $rules;
    }
}
