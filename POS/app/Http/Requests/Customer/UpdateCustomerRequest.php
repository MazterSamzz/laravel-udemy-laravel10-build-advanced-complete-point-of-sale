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
            'phone' => ['required', 'max:100', Rule::unique('customers')->ignore($id)],
            'address' => ['required'],
            'shopname' => ['required'],
            'photo' => ['nullable'],
            'bank_name' => ['required'],
            'account_holder' => ['required'],
            'account_number' => ['required'],
            'bank_branch' => ['required'],
            'city' => ['required']
        ];

        return $rules;
    }
}
