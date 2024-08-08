<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:200', 'unique'],
            'phone' => ['required', 'regex:/^0[1-9][0-9]{7,12}$/'],
            'address' => ['required', 'max:400'],
            'salary' => ['required', 'number'],
        ];
    }
}
