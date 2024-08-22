<?php

namespace App\Http\Requests\AdvanceSalary;

use App\Models\Backend\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreAdvanceSalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('amount'))
            $amount = str_replace(',', '', $this->input('amount')); // Menghapus koma

        $this->merge([
            'month' => intval($this->input('month')),
            'year' => intval($this->input('year')),
            'amount' => intval($amount)
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
            'employee_id' => ['required', 'exists:employees,id'],
            'month' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
        ];
    }

    /**
     * Hook to add custom validation logic after the default validation rules.
     *
     * @param Validator $validator The validator instance.
     * @return void
     */
    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $employee = Employee::find($this->input('employee_id'));

            if ($employee && $this->input('amount') > $employee->salary) {
                $validator->errors()->add('amount', "The amount cannot exceed the employee's salary.");
            }
        });
    }
}
