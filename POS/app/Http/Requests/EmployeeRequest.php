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
        return true;
    }

    /**
     * Prepares the request data for validation by cleaning and converting the salary value.
     *
     * If the request contains a 'salary' field, this method removes any commas from the value and converts it to an integer.
     * The cleaned salary value is then merged back into the request data.
     *
     * @return void
     */
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
            'email' => ['required', 'email', 'max:200', 'unique:employees,email'],
            'phone' => ['required', 'regex:/^0[1-9][0-9]{7,12}$/'],
            'address' => ['nullable', 'max:255'],
            'experience' => ['nullable'],
            'salary' => ['required', 'numeric', 'regex:/^\d*(\,\d{1,2})?$/'],
            'leave' => ['required', 'min:0'],
            'city' => ['nullable'],
            'photo' => ['nullable', 'image'],
        ];
    }
}
