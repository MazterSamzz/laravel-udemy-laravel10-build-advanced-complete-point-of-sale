<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required', 'unique:customers,name'],
            'email' => ['required', 'unique:customers,email'],
            'phone' => ['required', 'unique:customers,phone'],
            'address' => ['required'],
            'shopname' => ['required'],
            'image' => ['nullable'],
            'bank_name' => ['required'],
            'account_holder' => ['required'],
            'account_number' => ['required'],
            'bank_branch' => ['required'],
            'city' => ['required']
        ];
        return $rules;
    }
}
