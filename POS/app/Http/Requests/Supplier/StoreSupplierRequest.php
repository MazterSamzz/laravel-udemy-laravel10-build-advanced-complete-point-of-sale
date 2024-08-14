<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if ($this->has('salary')) {
            $salary = $this->input('salary');
            $salary = str_replace(',', '', $salary); // Menghapus koma
            $salary = intval($salary);

            $this->merge([
                'salary' => $salary,
            ]);
        }

        if ($this->has('experience')) {
            $experience = intval($this->input('experience'));
            $this->merge([
                'experience' => $experience,
            ]);
        }
    }
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
