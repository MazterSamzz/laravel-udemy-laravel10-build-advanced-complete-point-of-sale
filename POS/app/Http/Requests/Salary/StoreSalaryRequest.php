<?php

namespace App\Http\Requests\Salary;

use App\Models\Backend\Salary;
use Illuminate\Foundation\Http\FormRequest;

class StoreSalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepares the request data for validation by cleaning and converting the amount value.
     *
     * If the request contains a 'amount' field, this method removes any commas from the value and converts it to an integer.
     * The cleaned amount value is then merged back into the request data.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'year' => intval($this->input('year')),
            'month' => intval($this->input('month')),
            'paid' => intval($this->input('paid')),
            'advance' => intval($this->input('advance')),
            'due' => intval($this->input('due')),
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
            'month' => ['required', 'min:1', 'max:12'],
            'year' => ['required', 'min:1', 'max:9999'],
            'paid' => ['required', 'min:0', 'numeric'],
            'advance' => ['required', 'min:0', 'numeric'],
            'due' => ['required', 'min:0', 'numeric'],
        ];
    }
}
