<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $id = $this->route('customer');

        $rules = [
            'name' => ['required', 'max:100', Rule::unique('customers')->ignore($id)],
            'email' => ['required', 'max:100', Rule::unique('customers')->ignore($id)],
            'phone' => ['required', 'max:100', Rule::unique('customers')->ignore($id), 'regex:/^0[1-9][0-9]{7,12}$/'],
            'address' => ['required', 'string'],
            'shopname' => ['required', 'string'],
            'photo' => ['nullable', 'image'],
            'bank_name' => ['required', 'string'],
            'account_holder' => ['required', 'string'],
            'account_number' => ['required', 'string'],
            'bank_branch' => ['required', 'string'],
            'city' => ['required', 'string']
        ];

        return $rules;
    }
}
