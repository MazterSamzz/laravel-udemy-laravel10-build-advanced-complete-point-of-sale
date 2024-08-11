<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        if ($this->has('experience')) {
            $experience = intval($this->input('experience'));
            $this->merge([
                'experience' => $experience,
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
        $rules = [];

        if ($this->isMethod('post') || $this->isMethod('put')) {
            $rules = [ // Validasi create dan update
                'address' => ['nullable', 'max:255'],
                'experience' => ['nullable', 'numeric', 'min:0'],
                'salary' => ['required', 'numeric', 'regex:/^\d*(\,\d{1,2})?$/'],
                'leave' => ['required', 'min:0'],
                'city' => ['nullable'],
                'photo' => ['nullable', 'image'],
            ];

            if ($this->isMethod('post')) { // Validasi create
                $rules['name'] = ['required', 'max:100', 'unique:employees,name'];
                $rules['email'] = ['required', 'email', 'max:200', 'unique:employees,email'];
                $rules['phone'] = ['required', 'regex:/^0[1-9][0-9]{7,12}$/', 'unique:employees,phone'];
            } else { // Validasi update
                $id = $this->route('employee');
                $rules['name'] = ['required', 'max:100', Rule::unique('employees')->ignore($id)];
                $rules['email'] = ['required', 'email', 'max:200', Rule::unique('employees')->ignore($id)];
                $rules['phone'] = ['required', 'regex:/^0[1-9][0-9]{7,12}$/', Rule::unique('employees')->ignore($id)];
            }
        }
        return $rules;
    }
}
